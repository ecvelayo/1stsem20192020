import 'package:google_maps_flutter/google_maps_flutter.dart';
import 'package:shared_preferences/shared_preferences.dart';
import 'package:flutter_screenutil/flutter_screenutil.dart';
import 'package:bts_driverapp/test2/authorization.dart';
import 'package:cloud_firestore/cloud_firestore.dart';
import 'package:geoflutterfire/geoflutterfire.dart';
import 'package:firebase_auth/firebase_auth.dart';
import 'package:geolocator/geolocator.dart';
import 'package:provider/provider.dart';
import 'package:flutter/material.dart';
import 'dart:async';

class DriverHomePage extends StatefulWidget {
  final FirebaseUser currentUser;
  DriverHomePage(this.currentUser);

  @override
  _DriverHomePageState createState() => _DriverHomePageState();
}

class _DriverHomePageState extends State<DriverHomePage> {
  bool switchToggle = true;
  BitmapDescriptor busIcon, busStopIcon;
  var currentLocation;
  String _beepUnit;
  String _route;
  int _routeNumber;
  DocumentReference beepUnit;
  MediaQueryData queryData;

  Map<MarkerId, Marker> markers = <MarkerId, Marker>{};

  Geoflutterfire geo = Geoflutterfire();
  Firestore _firestore = Firestore.instance;
  FirebaseAuth auth = FirebaseAuth.instance;
  DocumentSnapshot _currentDocument;

  DateTime now = DateTime.now();
  var currentTime = new DateTime(DateTime.now().year, DateTime.now().month,
      DateTime.now().day, DateTime.now().hour, DateTime.now().minute);

  bool isOffline = false;
  bool beepView = false;
  var fname, lname, contactNumber;
  var commuter, destination, rStatus;
  var _stop;
  TextEditingController _textFieldController = TextEditingController();

  @override
  void initState() {
    super.initState();
    getToken();
    Geolocator().getCurrentPosition().then((currLoc) {
      setState(() {
        currentLocation = currLoc;
      });
      Firestore.instance
          .collection('driver')
          .document(widget.currentUser.uid)
          .get()
          .then((DocumentSnapshot driver) {
        setState(() {
          fname = driver.data['fname'];
          lname = driver.data['lname'];
          contactNumber = driver.data['contact_number'];
        });
        _startQuery();
      });
    });
    Firestore.instance
        .collection('busUnit')
        .where('beepid', isEqualTo: _beepUnit)
        .getDocuments()
        .then((route) {
      if (route.documents.isNotEmpty) {
        route.documents.forEach((f) {
          setState(() {
            if (f['beepid'] == _beepUnit) {
              _route = f['route'].toString();
              print(_route);
            }
          });
        });
      }
    });
    Firestore.instance
        .collection('busUnit')
        .where('beepid', isEqualTo: _beepUnit)
        .getDocuments()
        .then((routeNum) {
      if (routeNum.documents.isNotEmpty) {
        routeNum.documents.forEach((f) {
          setState(() {
            if (f['beepid'] == _beepUnit) {
              if (f['route'] == 'Route 1: City Hall - IT Park') {
                _routeNumber = 1;
              } else if (f['route'] == 'Route 2: Banawa - Panagdait') {
                _routeNumber = 2;
              } else if (f['route'] == 'Route 3: Guadalupe - Colon') {
                _routeNumber = 3;
              }
            }
          });
        });
      }
    });
    Firestore.instance
        .collection('reserveBeep')
        .where('beepUnit', isEqualTo: _beepUnit)
        .getDocuments()
        .then((reserveVip) {
      if (reserveVip.documents.isNotEmpty) {
        reserveVip.documents.forEach((v) {
          setState(() {
            if (v['beepUnit'] == _beepUnit) {
              setState(() {
                commuter = v['uid'];
                destination = v['busStop'];
                rStatus = v['status'];
              });
            }
          });
        });
      }
    });
  }

  // _updateBusInfo() async {
  //   Firestore.instance
  //       .collection('bus')
  //       .document(beepUnit.documentID)
  //       .updateData(
  //           {'name': _beepUnit, 'driver': fname, 'route': _routeNumber});
  // }

  _startQuery() async {
    final FirebaseUser user = await auth.currentUser();
    final uid = user.uid;

    var geolocator = Geolocator();
    var locationOptions =
        LocationOptions(accuracy: LocationAccuracy.high, distanceFilter: 20);

    GeoFirePoint center = geo.point(
        latitude: currentLocation.latitude,
        longitude: currentLocation.longitude);
    var collectionReference = Firestore.instance.collection('bus');
    var geoRef = geo.collection(collectionRef: collectionReference);

    beepUnit = await collectionReference.add({
      'name': _beepUnit,
      'position': center.data,
      'availability': true,
      'status': 1,
      'driver': fname,
      'route': _routeNumber
    });

    // Firestore.instance
    //     .collection('bus')
    //     .document(beepUnit.documentID)
    //     .updateData({'driver': fname, 'route': _routeNumber});

    // _updateBusInfo();

    StreamSubscription<Position> positionStream = geolocator
        .getPositionStream(locationOptions)
        .listen((Position position) {
      geoRef.setPoint(beepUnit.documentID, 'position', position.latitude,
          position.longitude);
      print(position == null
          ? 'Unknown'
          : position.latitude.toString() +
              ', ' +
              position.longitude.toString());
    });
  }

  logoutStatus() async {
    await _firestore
        .collection('bus')
        .document(_currentDocument.documentID)
        .updateData({'status': 0});
  }

  getToken() async {
    SharedPreferences prefs = await SharedPreferences.getInstance();
    _beepUnit = prefs.getString('beepUnit');

    print(_beepUnit);
  }

  removeToken() async {
    setState(() {
      Firestore.instance
          .collection('bus')
          .document(beepUnit.documentID)
          .updateData({'status': 0});
    });
    SharedPreferences prefs = await SharedPreferences.getInstance();
    prefs.remove('beepUnit');
    print('dumped');
  }

  @override
  // Duration get trans => const Duration(seconds: 5);
  Widget build(BuildContext context) {
    double defaultScreenWidth = 400.0;
    double defaultScreenHeight = 810.0;
    ScreenUtil.instance = ScreenUtil(
      width: defaultScreenWidth,
      height: defaultScreenHeight,
      allowFontScaling: true,
    )..init(context);

    return Scaffold(
      drawer: Drawer(
        child: SafeArea(
          child: Center(
            child: Column(
              children: <Widget>[
                SizedBox(
                  height: ScreenUtil.instance.setHeight(10.0),
                ),
                CircleAvatar(
                  backgroundColor: Colors.grey[200],
                  backgroundImage: AssetImage('lib/assets/btslogo.png'),
                  radius: ScreenUtil.instance.setWidth(50.0),
                ),
                SizedBox(
                  height: ScreenUtil.instance.setHeight(10.0),
                ),
                Row(
                  mainAxisAlignment: MainAxisAlignment.center,
                  crossAxisAlignment: CrossAxisAlignment.center,
                  children: <Widget>[
                    FlatButton(
                      onPressed: () {
                        showDialog(
                            context: context,
                            builder: (_) => new AlertDialog(
                                    title: new Text("Need Maintenance?"),
                                    content: TextField(
                                      controller: _textFieldController,
                                      decoration: InputDecoration(
                                          hintText: "What's wrong?"),
                                    ),
                                    actions: <Widget>[
                                      new FlatButton(
                                        child: new Text('Close'),
                                        onPressed: () {
                                          Navigator.of(context).pop();
                                        },
                                      ),
                                      new FlatButton(
                                        child: new Text('Confirm'),
                                        onPressed: () {
                                          Firestore.instance
                                              .collection('maintenance')
                                              .document()
                                              .setData({
                                            'driver': fname,
                                            'driverid': widget.currentUser.uid,
                                            'comment':
                                                _textFieldController.text,
                                            'status': 1
                                          });
                                          Navigator.of(context).pop();
                                        },
                                      )
                                    ]));
                      },
                      child: Icon(
                        Icons.warning,
                        color: Colors.yellow,
                      ),
                    ),
                    // FlatButton(
                    //   onPressed: () {
                    //     setState(() {
                    //       Firestore.instance
                    //           .collection('maintenance')
                    //           .document()
                    //           .setData({
                    //         'driver': fname,
                    //         'driverid': widget.currentUser.uid,
                    //         'comment': 'guba among ligid',
                    //         'status': 1
                    //       });
                    //     });
                    //   },
                    //   child: Icon(
                    //     Icons.cancel,
                    //     color: Colors.orange[300],
                    //   ),
                    // ),
                    // FlatButton(
                    //   onPressed: () {
                    //     setState(() {
                    //       Firestore.instance
                    //           .collection('maintenance')
                    //           .document()
                    //           .setData({
                    //         'driver': fname,
                    //         'driverid': widget.currentUser.uid,
                    //         'comment': 'TABANG GITULIS MI',
                    //         'status': 1
                    //       });
                    //     });
                    //   },
                    //   child: Icon(
                    //     Icons.error,
                    //     color: Colors.red,
                    //   ),
                    // ),
                  ],
                ),
                SizedBox(
                  height: ScreenUtil.instance.setHeight(10.0),
                ),
                RaisedButton(
                  color: Colors.lightBlue,
                  child: Text(
                    'LOGOUT',
                    style: TextStyle(color: Colors.white),
                  ),
                  onPressed: () async {
                    await Provider.of<AuthService>(context).logout();
                    removeToken();
                  },
                ),
              ],
            ),
          ),
        ),
      ),
      appBar: AppBar(
        title: Center(child: Text("BEEP Driver Application")),
      ),
      body: Center(
        child: Column(
          children: <Widget>[
            Container(
              padding: EdgeInsets.only(
                  top: ScreenUtil.instance.setWidth(5.0),
                  left: ScreenUtil.instance.setHeight(15.0),
                  right: ScreenUtil.instance.setHeight(15.0)),
              child: Card(
                elevation: 8.0,
                child: Column(
                  children: <Widget>[
                    SizedBox(
                      height: ScreenUtil.instance.setHeight(20.0),
                    ),
                    Container(
                      padding: EdgeInsets.only(
                          top: ScreenUtil.instance.setWidth(5.0),
                          left: ScreenUtil.instance.setHeight(60.0),
                          right: ScreenUtil.instance.setHeight(60.0)),
                      child: Row(
                        mainAxisAlignment: MainAxisAlignment.center,
                        children: <Widget>[
                          Text(
                            fname ?? ' ',
                            style: TextStyle(
                              fontSize: ScreenUtil.instance.setSp(30.0),
                            ),
                            overflow: TextOverflow.ellipsis,
                          ),
                          Text(
                            ' ',
                            style: TextStyle(
                              fontSize: ScreenUtil.instance.setSp(20.0),
                            ),
                            overflow: TextOverflow.ellipsis,
                          ),
                          Text(
                            lname ?? ' ',
                            style: TextStyle(
                              fontSize: ScreenUtil.instance.setSp(30.0),
                            ),
                            overflow: TextOverflow.ellipsis,
                          ),
                        ],
                      ),
                    ),
                    Container(
                      padding: EdgeInsets.only(
                          top: ScreenUtil.instance.setHeight(10.0),
                          bottom: ScreenUtil.instance.setWidth(10.0)),
                      child: Text(
                        widget.currentUser.email,
                        style: TextStyle(
                            fontSize: ScreenUtil.instance.setSp(17.0)),
                      ),
                    ),
                    Container(
                      padding: EdgeInsets.only(
                          bottom: ScreenUtil.instance.setWidth(10.0)),
                      child: Text(
                        contactNumber ?? ' ',
                        style: TextStyle(
                            fontSize: ScreenUtil.instance.setSp(17.0)),
                      ),
                    ),
                    SizedBox(
                      height: ScreenUtil.instance.setHeight(20.0),
                    ),
                  ],
                ),
              ),
            ),
            Row(
              children: <Widget>[
                Container(
                  padding: EdgeInsets.only(
                      top: ScreenUtil.instance.setWidth(5.0),
                      left: ScreenUtil.instance.setHeight(15.0),
                      right: ScreenUtil.instance.setHeight(10.0)),
                  child: Card(
                    elevation: 8.0,
                    child: Column(
                      crossAxisAlignment: CrossAxisAlignment.start,
                      children: <Widget>[
                        SizedBox(
                          height: ScreenUtil.instance.setHeight(20.0),
                        ),
                        Container(
                          padding: EdgeInsets.only(
                              bottom: ScreenUtil.instance.setWidth(10.0)),
                          child: Row(
                            mainAxisAlignment: MainAxisAlignment.start,
                            children: <Widget>[
                              Container(
                                padding: EdgeInsets.only(
                                    left: ScreenUtil.instance.setHeight(10.0)),
                                child: Text(
                                  'BEEP Unit: ',
                                  style: TextStyle(
                                      fontSize:
                                          ScreenUtil.instance.setSp(20.0)),
                                  overflow: TextOverflow.ellipsis,
                                ),
                              ),
                              Text(
                                _beepUnit ?? ' ',
                                style: TextStyle(
                                    fontSize: ScreenUtil.instance.setSp(20.0),
                                    fontWeight: FontWeight.bold),
                                overflow: TextOverflow.ellipsis,
                              ),
                            ],
                          ),
                        ),
                        Container(
                          padding: EdgeInsets.only(
                              right: ScreenUtil.instance.setHeight(10.0),
                              left: ScreenUtil.instance.setHeight(10.0),
                              bottom: ScreenUtil.instance.setWidth(10.0)),
                          child: Text(
                            _route ?? ' ',
                            style: TextStyle(
                                fontSize: ScreenUtil.instance.setSp(18.5),
                                fontWeight: FontWeight.bold),
                          ),
                        ),
                        SizedBox(
                          height: ScreenUtil.instance.setHeight(20.0),
                        ),
                      ],
                    ),
                  ),
                ),
                Container(
                  padding: EdgeInsets.only(
                      top: ScreenUtil.instance.setWidth(5.0),
                      left: ScreenUtil.instance.setHeight(5.0),
                      right: ScreenUtil.instance.setHeight(5.0)),
                  child: Card(
                    elevation: 8.0,
                    child: Column(
                      mainAxisAlignment: MainAxisAlignment.center,
                      crossAxisAlignment: CrossAxisAlignment.center,
                      children: <Widget>[
                        SizedBox(
                          height: ScreenUtil.instance.setHeight(20.0),
                        ),
                        Container(
                          padding: EdgeInsets.only(
                              left: ScreenUtil.instance.setHeight(10.0),
                              right: ScreenUtil.instance.setHeight(10.0)),
                          child: Text(
                            'Availability',
                            style: TextStyle(
                                fontSize: ScreenUtil.instance.setSp(15.0),
                                fontWeight: FontWeight.bold),
                          ),
                        ),
                        Container(
                          child: Switch(
                            value: switchToggle,
                            onChanged: (value) {
                              setState(() {
                                switchToggle = value;
                              });
                              Firestore.instance
                                  .collection('bus')
                                  .document(beepUnit.documentID)
                                  .updateData({'availability': switchToggle});
                            },
                            activeColor: Colors.lightBlue,
                            activeTrackColor: Colors.lightBlueAccent,
                          ),
                        ),
                        SizedBox(
                          height: ScreenUtil.instance.setHeight(20.0),
                        ),
                      ],
                    ),
                  ),
                ),
              ],
            ),
            Container(
              padding: EdgeInsets.only(
                  top: ScreenUtil.instance.setWidth(5.0),
                  left: ScreenUtil.instance.setHeight(15.0),
                  right: ScreenUtil.instance.setHeight(15.0)),
              // child: VipListView(),
              child: StreamBuilder(
                stream: Firestore.instance
                    .collection('reserveBeep')
                    .where('beepUnit', isEqualTo: _beepUnit)
                    .where('status', isEqualTo: true)
                    .snapshots(),
                builder: (context, snapshot) {
                  if (snapshot.connectionState == ConnectionState.waiting)
                    return CircularProgressIndicator();

                  return Card(
                    elevation: 8.0,
                    child: SizedBox(
                      height: ScreenUtil.instance.setHeight(230.0),
                      child: ListView.builder(
                        itemCount: snapshot.data.documents.length,
                        itemBuilder: (context, index) {
                          DocumentSnapshot doc = snapshot.data.documents[index];
                          return Container(
                            padding: EdgeInsets.only(
                                top: ScreenUtil.instance.setWidth(8.0),
                                bottom: ScreenUtil.instance.setWidth(6.0)),
                            child: Card(
                              child: Row(
                                children: <Widget>[
                                  Container(
                                    padding: EdgeInsets.only(
                                        top: ScreenUtil.instance.setWidth(5.0),
                                        left:
                                            ScreenUtil.instance.setHeight(5.0),
                                        right: ScreenUtil.instance
                                            .setHeight(25.0)),
                                    child: Text(
                                      commuter,
                                      style: TextStyle(
                                          fontSize:
                                              ScreenUtil.instance.setSp(14.0)),
                                    ),
                                  ),
                                  Container(
                                    padding: EdgeInsets.only(
                                        top: ScreenUtil.instance.setWidth(5.0),
                                        left:
                                            ScreenUtil.instance.setHeight(5.0),
                                        right: ScreenUtil.instance
                                            .setHeight(25.0)),
                                    child: Text(
                                      destination,
                                      style: TextStyle(
                                          fontSize:
                                              ScreenUtil.instance.setSp(12.0)),
                                    ),
                                  ),
                                  // Container(
                                  //   padding: EdgeInsets.only(
                                  //       top: ScreenUtil.instance.setWidth(5.0),
                                  //       left:
                                  //           ScreenUtil.instance.setHeight(5.0),
                                  //       right: ScreenUtil.instance
                                  //           .setHeight(10.0)),
                                  //   child: Text(
                                  //     rStatus,
                                  //     style: TextStyle(
                                  //         fontSize:
                                  //             ScreenUtil.instance.setSp(12.0)),
                                  //   ),
                                  // ),
                                ],
                              ),
                            ),
                          );
                        },
                      ),
                    ),
                  );
                },
              ),
            ),
            StreamBuilder(
                stream: Firestore.instance
                    .collection('trackedBeep')
                    .where('beepUnit', isEqualTo: _beepUnit)
                    .where('status', isEqualTo: 1)
                    .snapshots(),
                builder: (context, snapshot) {
                  return Container(
                    padding: EdgeInsets.only(
                        top: ScreenUtil.instance.setWidth(5.0),
                        left: ScreenUtil.instance.setHeight(15.0),
                        right: ScreenUtil.instance.setHeight(15.0)),
                    child: Card(
                      elevation: 8.0,
                      child: Column(
                        mainAxisAlignment: MainAxisAlignment.center,
                        crossAxisAlignment: CrossAxisAlignment.center,
                        children: <Widget>[
                          Container(
                            padding: EdgeInsets.only(
                                top: ScreenUtil.instance.setWidth(5.0),
                                bottom: ScreenUtil.instance.setWidth(10.0),
                                left: ScreenUtil.instance.setHeight(15.0),
                                right: ScreenUtil.instance.setHeight(15.0)),
                            child: Text(
                              'Incoming Passengers',
                              style: TextStyle(
                                  fontSize: ScreenUtil.instance.setSp(20.0),
                                  fontWeight: FontWeight.bold),
                            ),
                          ),
                          Container(
                            child: Text(
                              snapshot.data.documents.length.toString(),
                              style: TextStyle(
                                  fontSize: ScreenUtil.instance.setSp(20.0)),
                            ),
                          ),
                        ],
                      ),
                    ),
                  );
                }),
            // Container(
            //   child: Card(
            //     elevation: 8.0,
            //     child: StreamBuilder<QuerySnapshot>(
            //         stream: Firestore.instance
            //             .collection('busStop')
            //             .where('route', isEqualTo: _routeNumber)
            //             .snapshots(),
            //         builder: (BuildContext context,
            //             AsyncSnapshot<QuerySnapshot> snapshot) {
            //           if (snapshot.hasError)
            //             return new CircularProgressIndicator();
            //           return DropdownButton(
            //             underline: SizedBox(),
            //             value: _stop,
            //             isExpanded: true,
            //             hint: Padding(
            //               padding:
            //                   const EdgeInsets.fromLTRB(20.0, 2.0, 10.0, 0.0),
            //               child: Row(
            //                 children: <Widget>[
            //                   Icon(
            //                     Icons.beach_access,
            //                     color: Colors.grey,
            //                     size: 13,
            //                   ),
            //                   Text('Destination'),
            //                 ],
            //               ),
            //             ),
            //             disabledHint: Padding(
            //               padding:
            //                   const EdgeInsets.fromLTRB(20.0, 2.0, 10.0, 0.0),
            //               child: Row(
            //                 children: <Widget>[
            //                   Icon(
            //                     Icons.warning,
            //                     color: Colors.grey,
            //                     size: 13,
            //                   ),
            //                   Text('Please wait'),
            //                 ],
            //               ),
            //             ),
            //             elevation: 16,
            //             style: TextStyle(
            //               color: Colors.blue,
            //               fontSize: 13.0,
            //             ),
            //             onChanged: (busStop) {
            //               setState(() {
            //                 _stop = busStop;
            //                 beepView = true;
            //                 // trackStops(_stop);
            //               });
            //             },
            //             items: snapshot.data.documents
            //                 .map((DocumentSnapshot document) {
            //               print(document['name']);
            //               return new DropdownMenuItem<String>(
            //                 value: document['name'],
            //                 child: new Container(
            //                   padding:
            //                       EdgeInsets.fromLTRB(20.0, 2.0, 10.0, 0.0),
            //                   child: Row(
            //                     children: <Widget>[
            //                       new Icon(
            //                         Icons.beach_access,
            //                         color: Colors.grey,
            //                       ),
            //                       new Text(' ${document['name']}'),
            //                     ],
            //                   ),
            //                 ),
            //               );
            //             }).toList(),
            //           );
            //         }),
            //   ),
            // ),
          ],
        ),
      ),
    );
  }
}
