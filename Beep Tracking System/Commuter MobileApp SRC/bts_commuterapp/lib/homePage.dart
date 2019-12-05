import 'dart:async';
import 'package:firebase_auth/firebase_auth.dart';
import 'package:flutter/material.dart';
import 'package:geolocator/geolocator.dart';
import 'package:google_maps_flutter/google_maps_flutter.dart';
import 'package:cloud_firestore/cloud_firestore.dart';
import 'package:geoflutterfire/geoflutterfire.dart';
import 'package:flutter/services.dart' show rootBundle;
import 'package:shared_preferences/shared_preferences.dart';
import 'package:dio/dio.dart';
// export 'distance_matrix.dart';

String name;
String email;
String phoneNum;
String uid;
String type;
double money;

getToken() async {
  SharedPreferences prefs =  await SharedPreferences.getInstance();
    name = prefs.getString('name');
    email = prefs.getString('email');
    phoneNum = prefs.getString('phoneNum');
    type = prefs.getString('userType');

    if(phoneNum.contains('+63915')){
      Firestore.instance.collection('commuter').document(uid).setData({
        'uid': uid, 
        'contact_number': phoneNum, 
        'name': name,
        'email': email,
        'userType': 'Vip',
      },merge: true);
    }

    print(name);
    print(email);
    print(phoneNum);


  FirebaseUser currentUser = await FirebaseAuth.instance.currentUser();
  uid = currentUser.uid;
  prefs.setString('uid', uid);

  Firestore.instance.collection('commuter').
  where('uid', isEqualTo: uid).getDocuments().then((docs){

    if(docs.documents.isNotEmpty){
        docs.documents.forEach((userType){
            if(userType['userType'] ==  'Free'){
              type = 'Free';
              prefs.setString('type', type);
              print(type);
              Firestore.instance.collection('commuter').document(uid).
              setData({
                'uid': uid, 
                'contact_number': phoneNum, 
                'name': name,
                'email': email,
                'userType': type,
                }, merge: true
              );
                  
              money = userType['money'];
                
              if (money == null){
                prefs.setDouble('money', 0.0);
              } else {
                prefs.setDouble('money', money);
              }
            
            } else {
                type = userType['userType'];
                prefs.setString('type', type);
                Firestore.instance.collection('commuter').document(uid).
                  setData({
                    'uid': uid, 
                    'contact_number': phoneNum, 
                    'name': name,
                    'email': email,
                    'userType': type
                  }, merge: true
                );
                  Firestore.instance.collection('commuter').where('uid', isEqualTo: uid).snapshots().listen((a){
                a.documents.forEach((aa){
                  money = aa['money'];
                });
              });
              }
        });
      
    }  else { //docs.documents.isEmpty
        type = 'Free';
        prefs.setString('type', type);
        Firestore.instance.collection('commuter').document(uid).
                setData({
                  'uid': uid, 
                  'contact_number': phoneNum, 
                  'name': name,
                  'email': email,
                  'userType': type,
                  'money': 0,
                  'date_created': Timestamp.now(),
                  'date_expire': Timestamp.now()
                  });
      }
  });

  
}

removeToken() async {
  SharedPreferences prefs = await SharedPreferences.getInstance();
  prefs.remove('phoneNum');
  print('Dumped');
}


class HomeMap extends StatefulWidget {

  @override
  _HomeMapState createState() => _HomeMapState();
}

class _HomeMapState extends State<HomeMap> {
  @override
  Widget build(BuildContext context) {
    Firestore.instance.collection('commuter').where('uid', isEqualTo: uid).snapshots().listen((a){
                a.documents.forEach((aa){
                  money = aa['money'];
                });
              });
    getToken();
    return MaterialApp(
        home: Scaffold(
          drawer: Drawer(
            child: ListView(
              padding: EdgeInsets.zero,
              children: <Widget>[
                DrawerHeader(
                  child: CircleAvatar(
                    child: Image.asset('lib/assets/icon/BTSLogo.png'),
                        backgroundColor: Color(0xFF223172),
                        radius: 50,
                      ),
                  decoration: BoxDecoration(
                    // TODO: hello thom dri ang "good morning name"
                    color: Color(0xFFA2ADBC)
                  ),
                ),
                ListTile(
                  title: Text('Logs'),
                  onTap: () => Navigator.of(context).pushReplacementNamed('/commuterLogs'),
                ),
                ListTile(
                  title: Text('Account Details'),
                  onTap: () => Navigator.of(context).pushReplacementNamed('/accountDetails'),
                ),
                ListTile(
                  title: Text('File Complaint'),
                  onTap: () => complaint(),
                ),
            ],
          ),
        ),
                            
        body: Stack(
          children: <Widget>[
            
            MainMap(),
            new Positioned(
              top:5,
              left: 0,
              right: 0,
                child: AppBar(
                  backgroundColor: Colors.transparent,
                  elevation: 0,
              ),
            ),
            // MainMap(),
          ],
                  
        )
      )
    );
  }

  TextEditingController _textFieldController = TextEditingController();
  

  Future<void> complaint() async {
    String dropdownValue;
    return showDialog<void>(
      context: context,
      barrierDismissible: false,
      builder: (BuildContext context){
        return AlertDialog (
          title: Text('Complaint Form'),
          content: Container(
            child: Stack(
              children: <Widget>[
                DropdownButton<String>(
                  value: dropdownValue = 'driver',
                  icon: Icon(Icons.arrow_downward),
                  iconSize: 24,
                  elevation: 16,
                  style: TextStyle(
                    color: Colors.deepPurple
                  ),
                  underline: Container(
                    height: 2,
                    color: Colors.deepPurpleAccent,
                  ),
                  onChanged: (String newValue) {
                    
                      dropdownValue = newValue;
                      print(dropdownValue);
                    
                  },
                  items: <String>['driver', 'Facility']
                    .map<DropdownMenuItem<String>>((String value) {
                      return DropdownMenuItem<String>(
                        value: value,
                        child: Text(value),
                      );
                    })
                    .toList(),
                ),
                Container(
                  margin: EdgeInsets.only(top: 50),
                  decoration: BoxDecoration(
                    border: Border.all(width: 1),
                  ),
                  child: TextField(
                    autofocus: false,
                    keyboardType: TextInputType.text,
                    controller: _textFieldController,
                    minLines: 2,
                    maxLines: 4,
                    decoration: InputDecoration(hintText: 'Enter text here...'),
                  ),
                ),
              ],
            ),
          ),
          actions: <Widget>[
            new FlatButton(
              child: new Text('Close'),
              onPressed: (){
                Navigator.of(context).pop();
              }
            ),
            new FlatButton(
              child: new Text('Confirm'),
              onPressed: (){
                Firestore.instance.collection('complaints').add({'data': uid, 'type': dropdownValue,'description': _textFieldController.text, 'date_issued': Timestamp.now()});
                Navigator.of(context).pop();
              },
            )
          ],
        );
      }
    );
    
  }
}

class MainMap extends StatefulWidget {
  @override
  State createState() => MainMapState();
}


class MainMapState extends State<MainMap> {
  double flagPrice = 9.50;
  var collectionReference;
  DocumentSnapshot _contentFinal;
  int _state = 0;
  bool beepView = false;
  bool _vip = true;
  bool destinationView = false;
  bool _routeToggle = true;
  bool _button = false;
  bool _buttoncancel = false;
  bool _showdetails = false;
  double preprice;
  int _cardid;
  String _value, _stop, _newValue, busStop, _beep, _driver;
  String distance, distanced;
  DocumentReference trackedBeep, reserveBeep;
  String tbID;
  String _mapStyle;
  Stream<List<DocumentSnapshot>> stream;
  GeoPoint posFinal;
  bool isSelected;
  bool mapToggle = false; //mapToggle variable kay check if naay mareturn nga map
  GoogleMapController _mapController;
  // Completer<GoogleMapController> _controller = Completer();
  Map<String, List> _selected = {};
  Widget _child;
  BitmapDescriptor busIcon, busIconAvail, busIconFull, busStopIcon;

  var currentLocation; //catcher sa user location
  Dio dio = new Dio();


  Map<MarkerId, Marker> markers = <MarkerId, Marker>{}; //declaring markers
  Map<MarkerId, Marker> beepmarkers = <MarkerId, Marker>{};

  Geoflutterfire geo = Geoflutterfire(); //geopoint reference for _addgeopoint function
  Firestore _firestore = Firestore.instance; //firestore reference for _addgeopoint function
  
  void initState(){
    super.initState();
    rootBundle.loadString('lib/assets/map_style_day.txt').then((string) {
      _mapStyle = string;
    });
    BitmapDescriptor.fromAssetImage(
        ImageConfiguration(size: Size(48, 48)), 'lib/assets/icon/bus-marker-green.png')
        .then((onValue) {
          setState(() {
            busIconAvail = onValue;
          });
      });
    BitmapDescriptor.fromAssetImage(
        ImageConfiguration(size: Size(48, 48)), 'lib/assets/icon/bus-marker-red.png')
        .then((onValue) {
          setState(() {
            busIconFull = onValue;
          });
      });
    BitmapDescriptor.fromAssetImage(
        ImageConfiguration(size: Size(6, 6)), 'lib/assets/icon/bus-stop-balloon.png')
        .then((onValue) {
          setState(() {
           busStopIcon = onValue; 
          });
      });
    Geolocator().getCurrentPosition().then((currloc){
      setState((){
        currentLocation = currloc;
        mapToggle = true;
      });
      // _startQuery();
    });
  }

_startQuery(String _newValue, String _beep) async{
  if(_newValue == null){
    return;
  }
  print(_newValue);
  print(_value);
  GeoFirePoint center = geo.point(latitude: currentLocation.latitude, longitude: currentLocation.longitude);

  collectionReference = Firestore.instance.collection('bus').where('status', isEqualTo: 1);

  double radius = 20.0;
  
  // collectionReference.add({'name': 'random2', 'position': center.data});
  stream = geo.collection(collectionRef: collectionReference)
                                        .within(center: center, radius: radius, field: 'position', strictMode: true);

  stream.listen((List<DocumentSnapshot> documentList) {
    documentList.forEach((DocumentSnapshot document) {
      if(document.data['route'].toString() == _newValue){
        if(document.data['name'].toString() == _beep){
          var markerIdVal = document.documentID;
        final MarkerId markerId = MarkerId(markerIdVal);
        GeoPoint pos = document.data['position']['geopoint'];
        // setState(() {
        //   distance = document.data['distance'];
        // });
        distance = center.distance(lat: pos.latitude, lng: pos.longitude).toString();
        print(distance);
        setState(() {
          distance = distanced;
        });
        // Response response=await dio.get("https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=${currentLocation.latitude.toString()},${currentLocation.longitude.toString()}&destinations=${pos.latitude.toString()},${pos.longitude.toString()}&key=AIzaSyDrQb-Xy9Ijp_QrAiFnlVpQp8H5mrUbBl4");
        // print(response.data);
        // var element = response.data;
        // var row = element['rows'];
        // var dist = row['elements'];
        // print(dist);
        print(document.data['availability']);
        if(document.data['availability'] == true){
          setState(() {
          busIcon = busIconAvail; 
          });
        }else{
          setState(() {
          busIcon = busIconFull; 
          });
        }
        final Marker marker = Marker(
          markerId: markerId,
          position: LatLng(pos.latitude, pos.longitude),
          icon: busIcon,
          infoWindow: InfoWindow(title: document.data['name'])
        );
        setState(() {
        markers[markerId] = marker;
        print(markerId); 
        });
        }else{
          var markerIdVal = document.documentID;
        final MarkerId markerId = MarkerId(markerIdVal);
        GeoPoint pos = document.data['position']['geopoint'];
        // setState(() {
        //   distance = document.data['distance'];
        // });
        distance = center.distance(lat: pos.latitude, lng: pos.longitude).toString();
        print(distance);
        setState(() {
          distance = distanced;
        });
        // Response response=await dio.get("https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=${currentLocation.latitude.toString()},${currentLocation.longitude.toString()}&destinations=${pos.latitude.toString()},${pos.longitude.toString()}&key=AIzaSyDrQb-Xy9Ijp_QrAiFnlVpQp8H5mrUbBl4");
        // print(response.data);
        // var element = response.data;
        // var row = element['rows'];
        // var dist = row['elements'];
        // print(dist);
        print(document.data['availability']);
        if(document.data['availability'] == true){
          setState(() {
          busIcon = busIconAvail; 
          });
        }else{
          setState(() {
          busIcon = busIconFull; 
          });
        }
        final Marker marker = Marker(
          markerId: markerId,
          position: LatLng(pos.latitude, pos.longitude),
          icon: busIcon,
          infoWindow: InfoWindow(title: document.data['name'])
        );
        setState(() {
        markers[markerId] = marker;
        print(markerId); 
        });
        }
      }
    });
  });
}
  
  @override
  Widget build(BuildContext context){
    // debugShowCheckedModeBanner: false;
    if(type != 'Vip'){
      setState(() {
        _vip = true;
      });
    }
    return Stack(
      children: <Widget>[
        Container(
          child: mapToggle ?
          GoogleMap(
            onMapCreated: _onMapCreated,
            markers: Set<Marker>.of(markers.values),
            myLocationEnabled: true,
            mapToolbarEnabled: false,
            initialCameraPosition: CameraPosition(target: LatLng(currentLocation.latitude, currentLocation.longitude),
            zoom: 14),
            ):
            Center(child: 
            CircularProgressIndicator())
        ),
        StreamBuilder<QuerySnapshot>(
          stream: Firestore.instance.collection('route').snapshots(),
          builder: (BuildContext context, AsyncSnapshot<QuerySnapshot> snapshot){
            if (snapshot.hasError) return new Container();
            if (mapToggle == false) return new Container();
            return Visibility(
              visible: _routeToggle,
              child: new Positioned(
                  top: 80.0,
                  right: 15.0,
                  left: 15.0,
                  child: Container(
                    height: 50.0,
                    width: double.infinity,
                    decoration: BoxDecoration(
                      borderRadius: BorderRadius.circular(18.0),
                      color: Colors.white,
                      boxShadow: [
                        BoxShadow(
                          color: Colors.grey,
                          offset: Offset(1.0, 1.0),
                          blurRadius: 10,
                          spreadRadius: 3
                        )
                      ],
                    ),
                    child: DropdownButton(
                      underline: SizedBox(),
                      value: _value,
                      // icon: Icon(Icons.arrow_downward),
                      // iconSize: 24,
                      isExpanded: true,
                      hint: Padding(
                        padding: const EdgeInsets.fromLTRB(20.0, 2.0, 10.0, 0.0),
                        child: Row(
                          children: <Widget>[
                            Icon(Icons.art_track, color: Colors.grey, size: 13,),
                            Text('Route'),
                          ],
                        ),
                      ),
                      disabledHint: Text('Please wait'),
                      elevation: 16,
                      style: TextStyle(
                        color: Colors.blue,
                        fontSize: 13.0,
                      ),
                      onChanged: (_newValue){
                        setState(() {
                          _value = _newValue;
                          _stop = null;
                          if(type == 'Free'){
                            setState(() {
                              destinationView= false;
                            });
                          }else{
                            setState(() {
                              destinationView = true;
                            });
                          }
                          beepView = false;
                          _button = false;
                          _cardid = null;
                        });
                        populateStops(_newValue);
                        _startQuery(_newValue, _beep);
                        // populateBeeps(_newValue);
                      },
                      items: snapshot.data.documents.map((DocumentSnapshot document){
                        return new DropdownMenuItem<String>(
                          value: document['route'],
                          child: new Container(
                            padding: EdgeInsets.fromLTRB(20.0, 2.0, 10.0, 0.0),
                            child: Row(
                              children: <Widget>[
                                Icon(Icons.art_track, color: Colors.grey, size: 13,),
                                Text(' ${document['name']}'),
                              ],
                            ),
                          ),
                        );
                      }).toList(),
                    ),
                  ),
                ),
            );
          }),
          StreamBuilder<QuerySnapshot>(
          stream: Firestore.instance.collection('busStop').where('route', isEqualTo: _value).snapshots(),
          builder: (BuildContext context, AsyncSnapshot<QuerySnapshot> snapshot){
            if (snapshot.hasError) return new CircularProgressIndicator();
            return Visibility(
              visible: destinationView,
              child: new Positioned(
                  top: 140.0,
                  right: 15.0,
                  left: 15.0,
                  child: Container(
                    height: 50.0,
                    width: double.infinity,
                    decoration: BoxDecoration(
                      borderRadius: BorderRadius.circular(18.0),
                      color: Colors.white,
                      boxShadow: [
                        BoxShadow(
                          color: Colors.grey,
                          offset: Offset(1.0, 5.0),
                          blurRadius: 10,
                          spreadRadius: 3
                        )
                      ],
                    ),
                    child: DropdownButton(
                      underline: SizedBox(),
                      value: _stop,
                      // icon: Icon(Icons.arrow_downward),
                      // iconSize: 24,
                      isExpanded: true,
                      hint: Padding(
                        padding: const EdgeInsets.fromLTRB(20.0, 2.0, 10.0, 0.0),
                        child: Row(
                          children: <Widget>[
                            Icon(Icons.beach_access, color: Colors.grey, size: 13,),
                            Text('Destination'),
                          ],
                        ),
                      ),
                      disabledHint: Padding(
                        padding: const EdgeInsets.fromLTRB(20.0, 2.0, 10.0, 0.0),
                        child: Row(
                          children: <Widget>[
                            Icon(Icons.warning, color: Colors.grey, size: 13,),
                            Text('Please wait'),
                          ],
                        ),
                      ),
                      elevation: 16,
                      style: TextStyle(
                        color: Colors.blue,
                        fontSize: 13.0,
                      ),
                      onChanged: (busStop){
                        setState(() {
                          _stop = busStop;
                          beepView = true;
                          // trackStops(_stop);
                        });
                      },
                      items: snapshot.data.documents.map((DocumentSnapshot document){
                        return new DropdownMenuItem<String>(
                          value: document['name'],
                          child: new Container(
                            padding: EdgeInsets.fromLTRB(20.0, 2.0, 10.0, 0.0),
                            child: Row(
                              children: <Widget>[
                                new Icon(Icons.beach_access, color: Colors.grey,),
                                new Text(' ${document['name']}'),
                              ],
                            ),
                          ),
                        );
                      }).toList(),
                    ),
                  ),
                ),
            );
          }),
          StreamBuilder<QuerySnapshot>(
          stream: Firestore.instance.collection('bus').where('status', isEqualTo: 1).where('availability', isEqualTo: true).snapshots(),
          builder: (BuildContext context, AsyncSnapshot<QuerySnapshot> snapshot){
            if (snapshot.connectionState == ConnectionState.waiting) return CircularProgressIndicator();
            if (snapshot.hasError) return CircularProgressIndicator();
            if (!snapshot.hasData) return CircularProgressIndicator();
            // if(money >= flagPrice){
              return Visibility(
              visible: beepView,
              child: Align(
                alignment: Alignment.bottomCenter,
                child: new Row(
                  mainAxisAlignment: MainAxisAlignment.spaceEvenly,
                  children: <Widget>[
                    Expanded(
                      child: Padding(
                        padding: const EdgeInsets.fromLTRB(0, 0, 0, 45),
                        child: SizedBox(
                          height: 100.0,
                          child: new ListView.builder(
                            scrollDirection: Axis.horizontal,
                            itemCount: snapshot.data.documents.length,
                            itemBuilder: (BuildContext context, int index) {
                              // print(index);
                              DocumentSnapshot _content = snapshot.data.documents[index];
                              GeoFirePoint center = geo.point(latitude: currentLocation.latitude, longitude: currentLocation.longitude);
                              GeoPoint beepPos = _content['position']['geopoint'];
                              distance = center.distance(lat: beepPos.latitude, lng: beepPos.longitude).toStringAsFixed(1);
                              var distanceint = double.parse(distance);
                              if(distanceint < 1.0){ distance = 'Few';}
                              print('value $_value');
                              if(_content['route'].toString() == _value){
                                print('nisuloid');
                              return new Card(
                                  color: _cardid != index ? Colors.blue : Colors.grey,
                                  child: InkWell(
                                    splashColor: Colors.grey,
                                    hoverColor: Colors.orange,
                                    onTap: (){
                                      setState(() {
                                        _button = true;
                                        _cardid = index;
                                        _contentFinal = snapshot.data.documents[_cardid];
                                        _beep = _contentFinal['name'];
                                        posFinal = _contentFinal['position']['geopoint'];
                                        _driver = _contentFinal['driver'];
                                      });
                                      // print(_contentFinal['name']);
                                      _mapController.animateCamera(CameraUpdate.newCameraPosition(CameraPosition(target: LatLng(posFinal.latitude, posFinal.longitude), zoom: 15)));
                                    },
                                    child: Padding(
                                      padding: const EdgeInsets.all(10.0),
                                      child: new Row(
                                        crossAxisAlignment: CrossAxisAlignment.center,
                                        children: <Widget>[
                                          Padding(
                                            padding: const EdgeInsets.only(right: 8.0),
                                            child: Column(
                                              children: <Widget>[
                                                Text(distance, style: TextStyle(color: Colors.white, fontSize: 50)),
                                                Text('KILOMETERS', style: TextStyle(color: Colors.white, fontSize: 8))
                                              ],
                                            ),
                                          ),
                                          Column(
                                            mainAxisAlignment: MainAxisAlignment.center,
                                            children: <Widget>[
                                              Text(_content['name']),
                                              Text(_content['driver']),
                                              Text(_content['driver']),
                                            ],
                                          )
                                        ],
                                      ),
                                    ),
                                  ),
                                );
                              }
                            },
                          ),
                        ),
                      ),
                    ),
                  ],
                ),
              ),
            );
            // }else{
            //   return new Container(width: 0.0, height: 0.0,);
            // }
          }),
          Visibility(
            visible: _button,
            child: Align(
              alignment: Alignment.bottomCenter,
              child: SizedBox(
                width: 200,
                child: RaisedButton(
                  shape: RoundedRectangleBorder(
                          borderRadius: new BorderRadius.circular(18.0),
                  ),
                  color: Colors.green[800],
                  child: Text('TRACK', style: TextStyle(fontWeight: FontWeight.bold, color: Colors.white)),
                  onPressed: (){
                    setState(() {
                      _routeToggle = false;
                      destinationView = false;
                      beepView = false;
                      _buttoncancel = true;
                      _button = false;
                      _vip = true;
                      _showdetails = true;
                      collectionReference = Firestore.instance.collection('bus').where('status', isEqualTo: 1).where('name', isEqualTo: _beep);
                    });
                    trackStop(_stop);
                    // _startQuery(_newValue, _beep);
                    
                    addTrackbeep(_stop, _beep);
                    showTrackedBeep();

                  },
                ),
              ),
            ),
          ),
          Visibility(
            visible: _showdetails,
            child: Align(
              alignment: Alignment.bottomCenter,
              child: SizedBox(
                  width: 200,
                  child: RaisedButton(
                    shape: RoundedRectangleBorder(
                            borderRadius: new BorderRadius.circular(18.0),
                    ),
                    color: Colors.grey,
                    child: Text('SHOW DETAILS', style: TextStyle(fontWeight: FontWeight.bold, color: Colors.white)),
                    onPressed: (){
                      showTrackedBeep();
                      setState(() {
                        flagPrice = 9.50;
                      });
                      // setState(() {
                      //   _routeToggle = false;
                      //   destinationView = false;
                      //   beepView = false;
                      //   _buttoncancel = true;
                      //   _button = false;
                      //   collectionReference = Firestore.instance.collection('bus').where('status', isEqualTo: 1).where('name', isEqualTo: _beep);
                      // });
                      // trackStop(_stop);
                      // // _startQuery(_newValue, _beep);
                      
                      // addTrackbeep(_stop, _beep);
                      // showTrackedBeep();

                    },
                  ),
                ),
            ),
          ),
          Visibility(
            visible: _showdetails,
            child: Align(
              alignment: Alignment.bottomCenter,
              child: SizedBox(
                  width: 200,
                  child: RaisedButton(
                    shape: RoundedRectangleBorder(
                            borderRadius: new BorderRadius.circular(18.0),
                    ),
                    color: Colors.blue,
                    child: Text('ARRIVED', style: TextStyle(fontWeight: FontWeight.bold, color: Colors.white)),
                    onPressed: (){
                      setState(() {
                                markers.clear();
                                _routeToggle = true;
                                destinationView = false;
                                _buttoncancel = false;
                                _button = false;
                                collectionReference = Firestore.instance.collection('bus').where('status', isEqualTo: 1);

                                _newValue = null;
                                _stop = null;
                                _beep = null;
                                _cardid = null;
                                // _vip = false;
                                _showdetails = false;
                                _value = null;
                                flagPrice = 9.50;
                                donereservebeep();
                                doneTrackbeep();
                                // Navigator.pop(context);
                              });
                              // tr
                      // setState(() {
                      //   _routeToggle = false;
                      //   destinationView = false;
                      //   beepView = false;
                      //   _buttoncancel = true;
                      //   _button = false;
                      //   collectionReference = Firestore.instance.collection('bus').where('status', isEqualTo: 1).where('name', isEqualTo: _beep);
                      // });
                      // trackStop(_stop);
                      // // _startQuery(_newValue, _beep);
                      
                      // addTrackbeep(_stop, _beep);
                      // showTrackedBeep();

                    },
                  ),
                ),
            ),
          ),
        ]
      );
    }


// StreamBuilder<QuerySnapshot>(
//             stream: Firestore.instance.collection('bus').snapshots(),
//             builder: (BuildContext context, AsyncSnapshot<QuerySnapshot> snapshot){
//               print(snapshot.data.documents.length.toString());
              // if (destinationView == false) return new Container();
              // if (!snapshot.hasData) return new Container();
              // if(snapshot.connectionState == ConnectionState.waiting) return Container();
              // snapshot.data.documents.map((DocumentSnapshot document){
              //   print(document['status']);
              //   if(document['status'] == 1){
              //     return Positioned(
              //       bottom: 50, 
              //       child: new  ListView.builder(
              //         scrollDirection: Axis.horizontal,
              //         itemCount: snapshot.data.documents.length,
              //         itemBuilder: (context, index){
              //           final DocumentSnapshot _content = snapshot.data.documents[index];
              //           return Container(
              //             width: MediaQuery.of(context).size.width * 0.6,
              //             child: Card(
              //               color: Colors.blue,
              //               child: Container(
              //                 child: Row(
              //                   children: <Widget>[
              //                     Column(
              //                       children: <Widget>[
              //                         Text(_content['status'], style: TextStyle(fontSize: 10),),
              //                       ],
              //                     ),
              //                     Column(
              //                       children: <Widget>[
              //                         Row(
              //                           children: <Widget>[
              //                             Text(_content['status']),
              //                           ],
              //                         ),
              //                         Row(
              //                           children: <Widget>[
              //                             Text(_content['status'])
              //                           ],
              //                         ),
              //                         Row(
              //                           children: <Widget>[
              //                             Text(_content['status'])
              //                           ],
              //                         )
              //                       ],
              //                     )
              //                   ],
              //                 ),
              //               ),
              //             ),
              //           );
              //         },
              //       ),
              //     );
              //   }
              // }).toList();
              // return new Container();
          //   },
          // )




  void showTrackedBeep() async {
    print(currentLocation.latitude.toString());
    print(posFinal.latitude.toString());
    Response response = await dio.get(
        "https://maps.googleapis.com/maps/api/distancematrix/json?units=metric&origins=${currentLocation.latitude.toString()},${currentLocation.longitude.toString()}&destinations=${posFinal.latitude.toString()},${posFinal.longitude.toString()}&key=AIzaSyD1v2ExwIPZhsebmN00jRvd1nzZYPgkcqw");
    List rows = response.data['rows'];
    List elements = rows[0]['elements'];
    Map<String, dynamic> distance = elements[0]['distance'].cast<String, dynamic>();
    Map<String, dynamic> duration = elements[0]['duration'].cast<String, dynamic>();
    // if(distance['text'].toString() % 1 == 0){
      // String distanceWhole = distance['text'].toStringAsFixed(0);
      // var distanceConv = double.parse(distanceWhole);
      // double prePrice = distanceConv * 2;
      // final double price = prePrice + flagPrice;

        var hey = double.parse(distance['text'].replaceAll(RegExp(' km'), ''));
        print('hey $hey');
        int hey2 = (hey.round()).toInt();
        // int hey2 = int.parse(hey);
        // print(hey2);
        // double hey3 = hey2.toDouble();
        int preprice = hey2 * 2;
        // print('preprice: $preprice');
        double price = preprice + flagPrice;
        setState(() {
          flagPrice = price;
        });
    // }
    showBottomSheet(
      context: context,
      builder: (context){
        return Container(
            height: 210,
            // margin: const EdgeInsets.only(top: 5),
          child: Container(
            decoration: BoxDecoration(
              color: Colors.white,
              borderRadius: BorderRadius.only(topLeft: Radius.circular(25), topRight: Radius.circular(25)),
              boxShadow: [BoxShadow(blurRadius: 10, color: Colors.grey[300], spreadRadius: 5)],
            ),
            child: Center(
              child: Padding(
                padding: const EdgeInsets.all(15.0),
                child: Column(
                  mainAxisSize: MainAxisSize.max,
                  children: <Widget>[
                    Row(
                      children: <Widget>[
                        Expanded(
                          child: Column(
                            children: <Widget>[
                              Icon(Icons.timer, color: Colors.grey),
                              Text(duration['text'].toString())
                            ],
                          ),
                        ),
                        Expanded(
                          child: Column(
                            children: <Widget>[
                              Icon(Icons.timer, color: Colors.grey),
                              Text(distance['text'].toString())
                            ],
                          ),
                        ),
                        Expanded(
                          child: Column(
                            children: <Widget>[
                              Icon(Icons.timer, color: Colors.grey),
                              Text(_beep)
                            ],
                          ),
                        ),
                        Expanded(
                          child: Column(
                            children: <Widget>[
                              Icon(Icons.timer, color: Colors.grey),
                              Text(_driver)
                            ],
                          ),
                        ),
                      ],
                    ),
                    Padding(
                      padding: const EdgeInsets.all(5.0),
                      child: Row(
                        mainAxisAlignment: MainAxisAlignment.center,
                        children: <Widget>[
                          Column(
                            crossAxisAlignment: CrossAxisAlignment.center,
                            children: <Widget>[
                              Text('P $flagPrice', style: TextStyle(fontSize: 30))
                            ],
                          )
                        ],
                      ),
                    ),
                    Visibility(
                      visible: _vip,
                      child: Padding(
                        padding: const EdgeInsets.all(10.0),
                        child: SizedBox(
                              width: 250,
                              child: RaisedButton(
                                shape: RoundedRectangleBorder(
                                        borderRadius: new BorderRadius.circular(18.0),
                                ),
                                color: Colors.yellow[600],
                                // splashColor: Colors.yellow,
                                splashColor: Colors.yellow[400],
                                child: reserveProgress(),
                                onPressed: (){
                                  
                                  setState(() {
                                    _showdetails = true;
                                    reserveSeat();
                                    animateButton();
                                    _buttoncancel = false;
                                    _vip = false;
                                  });
                                  Navigator.pop(context);
                                  // setState(() {
                                  //   markers.clear();
                                  //   _routeToggle = true;
                                  //   destinationView = false;
                                  //   _buttoncancel = false;
                                  //   _button = false;
                                  //   collectionReference = Firestore.instance.collection('bus').where('status', isEqualTo: 1);

                                  //   _newValue = null;
                                  //   _stop = null;
                                  //   _beep = null;
                                  //   _cardid = null;

                                  // });
                                  //   cancelTrackbeep();
                                  //   Navigator.pop(context);
                                  // trackStops(_stop);
                                  // trackBeep(_beep);

                                },
                              ),
                            ),
                      ),
                    ),
                    Visibility(
                      visible: _buttoncancel,
                      child: SizedBox(
                          width: 100,
                          height: 20,
                          child: OutlineButton(
                            shape: RoundedRectangleBorder(
                                    borderRadius: new BorderRadius.circular(18.0),
                            ),
                            borderSide: BorderSide(color: Colors.red),
                            splashColor: Colors.red[300],
                            highlightedBorderColor: Colors.redAccent,
                            child: Text('CANCEL', style: TextStyle(fontWeight: FontWeight.bold, color: Colors.red)),
                            onPressed: (){
                              setState(() {
                                markers.clear();
                                _routeToggle = true;
                                destinationView = false;
                                _buttoncancel = false;
                                _button = false;
                                collectionReference = Firestore.instance.collection('bus').where('status', isEqualTo: 1);

                                _newValue = null;
                                _stop = null;
                                _beep = null;
                                _cardid = null;
                                // _vip = false;
                                _showdetails = false;
                                _value = null;
                                flagPrice = 9.50;

                                cancelTrackbeep();
                                Navigator.pop(context);
                              });
                              // trackStops(_stop);
                              // trackBeep(_beep);

                            },
                          ),
                        ),
                    )
                  ],
                ),
              ),
            ),
          ),
        );
      }
    );
  }






  void _onMapCreated(GoogleMapController controller) {
       setState(() {
        _mapController = controller;
        _mapController.setMapStyle(_mapStyle);
        // populateStops();
       });
  }

  void populateStops(String _newValue){
    markers.clear();
    Firestore.instance.collection('busStop').where("route", isEqualTo: _newValue).getDocuments().then((docs){
      if (docs.documents.isNotEmpty){
        for (var i = 0; i < docs.documents.length; i++) {
          initMarker(docs.documents[i].data, docs.documents[i].documentID);
        }
      }
    });
  }

  void trackStop(String _stop) {
    markers.clear();
    // Timer(Duration(seconds: 5), () {
    //   setState(() {
    //     _buttoncancel = false;
    //   });
    // });
        Firestore.instance.collection('busStop').where("name", isEqualTo: _stop).getDocuments().then((docs){
          if (docs.documents.isNotEmpty){
            for (var i = 0; i < docs.documents.length; i++) {
              initMarker(docs.documents[i].data, docs.documents[i].documentID);
            }
          }
        });
      }


  initMarker(beep, beepId){
    var markerIdVal = beepId;
    final MarkerId markerId = MarkerId(markerIdVal);
    //create marker
    final Marker marker = Marker(
      markerId: markerId,
      icon: busStopIcon,
      position: 
          LatLng(beep['location'].latitude, beep['location'].longitude),
      infoWindow:
          InfoWindow(title: beep['name'])
    );
    setState((){
      markers[markerId] = marker;
      print(markerId);
    });
  }

  addTrackbeep(String _stop, String _beep) async {
    trackedBeep = await Firestore.instance.collection('trackedBeep').add({'uid': 'chiekko', 'busStop': _stop, 'beepUnit': _beep, 'driver': _driver,'datetime_created': Timestamp.now(),'status': 1});
    // print(trackedBeep.documentID);
    // setState(() {
    //   tbID = trackedBeep.documentID.toString();
    // });
  }

  cancelTrackbeep(){
    // print(tbID);
    Firestore.instance.collection('trackedBeep').document(trackedBeep.documentID.toString()).updateData({'status': 0});
  }

  doneTrackbeep(){
    // print(tbID);
    Firestore.instance.collection('trackedBeep').document(trackedBeep.documentID.toString()).updateData({'status': 0});
    Firestore.instance.collection('commuter').document(uid).setData({'money': money-flagPrice}, merge: true);  
  }

  
  donereservebeep(){
    Firestore.instance.collection('reserveBeep').document(reserveBeep.documentID).updateData({'status': false}); 
  }


  reserveSeat() async {
    reserveBeep = await Firestore.instance.collection('reserveBeep').add({'uid': 'chiekko', 'busStop': _stop, 'beepUnit': _beep,'datetime_created': Timestamp.now(),'status': true});
  }


  Widget reserveProgress(){
    if (_state == 0) {
      return new Text(
        "RESERVE A SEAT",
        style: const TextStyle(
          color: Colors.white,
          fontSize: 16.0,
        ),
      );
    } else if (_state == 1) {
      return CircularProgressIndicator(
        valueColor: AlwaysStoppedAnimation<Color>(Colors.white),
      );
    } else {
      return Icon(Icons.check, color: Colors.white);
    }
  }

  void animateButton(){
    setState(() {
      _state = 1;
    });

    // Timer(Duration(milliseconds: 3300), () {
    //   setState(() {
    //     _state = 2;
    //   });
    // });
  }

}

