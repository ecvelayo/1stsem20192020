// import 'package:google_maps_flutter/google_maps_flutter.dart';
import 'package:flutter_screenutil/flutter_screenutil.dart';
import 'package:shared_preferences/shared_preferences.dart';
import 'package:bts_driverapp/test2/authorization.dart';
import 'package:cloud_firestore/cloud_firestore.dart';
// import 'package:geoflutterfire/geoflutterfire.dart';
import 'package:firebase_auth/firebase_auth.dart';
// import 'package:geolocator/geolocator.dart';
import 'package:provider/provider.dart';
import 'package:flutter/material.dart';
import 'dart:async';

class DriverLogin extends StatefulWidget {
  @override
  _DriverLoginState createState() => _DriverLoginState();
}

class _DriverLoginState extends State<DriverLogin> {
  final _formKey = GlobalKey<FormState>();
  String _email;
  String _password;
  String _beepUnit;
  // String _route;

  // @override
  // void initState() {
  //   super.initState();
  //   _getLocation();
  // }

  // var currentLocation;
  // var collectionReference;
  // var geolocator;
  // var locationOptions;
  // var geoRef;

  // Map<MarkerId, Marker> markers = <MarkerId, Marker>{};
  // Geoflutterfire geo = Geoflutterfire();
  // DocumentReference beepUnit;
  // GeoFirePoint center;

  // _getLocation() async {
  //   geolocator = Geolocator();
  //   locationOptions =
  //       LocationOptions(accuracy: LocationAccuracy.high, distanceFilter: 20);

  //   center = geo.point(
  //       latitude: currentLocation.latitude,
  //       longitude: currentLocation.longitude);
  //   collectionReference = Firestore.instance.collection('bus');
  //   geoRef = geo.collection(collectionRef: collectionReference);

  //   beepUnit = await collectionReference.add({
  //     'name': 'default unit',
  //     'position': center.data,
  //     'availability': true,
  //     'status': 1,
  //     'driver': 'default name',
  //     'route': 'default route'
  //   });

  //   StreamSubscription<Position> positionStream = geolocator
  //       .getPositionStream(locationOptions)
  //       .listen((Position position) {
  //     geoRef.setPoint(beepUnit.documentID, 'position', position.latitude,
  //         position.longitude);
  //     print(position == null
  //         ? 'Unknown'
  //         : position.latitude.toString() +
  //             ', ' +
  //             position.longitude.toString());
  //   });
  // }

  @override
  Widget build(BuildContext context) {
    double defaultScreenWidth = 400.0;
    double defaultScreenHeight = 810.0;
    ScreenUtil.instance = ScreenUtil(
      width: defaultScreenWidth,
      height: defaultScreenHeight,
      allowFontScaling: true,
    )..init(context);

    return Scaffold(
      body: Container(
        decoration: BoxDecoration(
          gradient: LinearGradient(
            begin: Alignment.topRight,
            end: Alignment.bottomLeft,
            colors: [Colors.blue[900], Colors.blue],
          ),
        ),
        child: Center(
          child: ListView(
            shrinkWrap: true,
            padding: EdgeInsets.all(ScreenUtil.instance.setWidth(15.0)),
            children: <Widget>[
              Center(
                child: Form(
                  key: _formKey,
                  child: Card(
                    elevation: 8.0,
                    child: Container(
                      padding:
                          EdgeInsets.all(ScreenUtil.instance.setWidth(10.0)),
                      child: Column(
                        children: <Widget>[
                          Align(
                              alignment: Alignment.topLeft,
                              child: Padding(
                                padding: EdgeInsets.all(
                                    ScreenUtil.instance.setWidth(8.0)),
                                child: Text(
                                  'Login',
                                  style: TextStyle(
                                      fontWeight: FontWeight.bold,
                                      fontSize:
                                          ScreenUtil.instance.setSp(50.0)),
                                ),
                              )),
                          Padding(
                            padding: EdgeInsets.all(
                                ScreenUtil.instance.setWidth(2.0)),
                            child: TextFormField(
                              onSaved: (value) => _email = value,
                              keyboardType: TextInputType.emailAddress,
                              decoration: InputDecoration(
                                prefixIcon: Icon(Icons.person),
                                labelText: "Email",
                              ),
                            ),
                          ),
                          SizedBox(
                            height: ScreenUtil.instance.setHeight(5.0),
                          ),
                          Padding(
                            padding: EdgeInsets.all(
                                ScreenUtil.instance.setWidth(2.0)),
                            child: TextFormField(
                              onSaved: (value) => _password = value,
                              obscureText: true,
                              decoration: InputDecoration(
                                prefixIcon: Icon(Icons.lock),
                                labelText: "Password",
                              ),
                            ),
                          ),
                          SizedBox(
                            height: ScreenUtil.instance.setHeight(15.0),
                          ),
                          Padding(
                            padding: EdgeInsets.all(
                                ScreenUtil.instance.setWidth(2.0)),
                            child: Row(
                              children: <Widget>[
                                // DropDownBeepUnit(_beepUnit),
                                SizedBox(
                                  width: ScreenUtil.instance.setWidth(7.0),
                                ),
                                StreamBuilder<QuerySnapshot>(
                                    stream: Firestore.instance
                                        .collection('busUnit')
                                        .where('status', isEqualTo: 'Garage')
                                        .snapshots(),
                                    builder: (BuildContext context,
                                        AsyncSnapshot<QuerySnapshot> snapshot) {
                                      if (snapshot.hasError)
                                        return new Text(
                                            'Error: ${snapshot.error}');
                                      switch (snapshot.connectionState) {
                                        case ConnectionState.waiting:
                                          return new Text(' ');
                                        default:
                                          return Container(
                                            padding: EdgeInsets.symmetric(
                                                horizontal:
                                                    ScreenUtil.instance.width /
                                                        40),
                                            decoration: BoxDecoration(
                                              borderRadius:
                                                  BorderRadius.circular(15.0),
                                              border: Border.all(
                                                  color: Colors.grey[500],
                                                  style: BorderStyle.solid,
                                                  width: 0.80),
                                            ),
                                            child: DropdownButtonHideUnderline(
                                              child: DropdownButton(
                                                isExpanded: false,
                                                elevation: 0,
                                                hint: Container(
                                                    child: Row(
                                                  children: <Widget>[
                                                    Icon(
                                                      Icons.directions_bus,
                                                      color: Colors.grey[500],
                                                      size: ScreenUtil.instance
                                                          .setSp(13.0),
                                                    ),
                                                    Text(
                                                      'Select BEEP Unit',
                                                      style: TextStyle(
                                                          fontSize: ScreenUtil
                                                              .instance
                                                              .setSp(13.0)),
                                                    ),
                                                  ],
                                                )),
                                                value: _beepUnit,
                                                onChanged: (newValue) {
                                                  setState(() {
                                                    _beepUnit = newValue;
                                                  });
                                                },
                                                items: snapshot.data.documents
                                                    .map((DocumentSnapshot
                                                        document) {
                                                  return DropdownMenuItem<
                                                      String>(
                                                    value:
                                                        document.data['beepid'],
                                                    child: Row(
                                                      children: <Widget>[
                                                        new Icon(
                                                          Icons.directions_bus,
                                                          size: ScreenUtil
                                                              .instance
                                                              .setSp(13.0),
                                                        ),
                                                        new Text(' '),
                                                        new Text(
                                                          document
                                                              .data['beepid'],
                                                          style: TextStyle(
                                                            fontSize: ScreenUtil
                                                                .instance
                                                                .setSp(13.0),
                                                          ),
                                                        ),
                                                      ],
                                                    ),
                                                  );
                                                }).toList(),
                                              ),
                                            ),
                                          );
                                      }
                                    }),
                              ],
                            ),
                          ),
                          SizedBox(
                            height: ScreenUtil.instance.setHeight(50.0),
                          ),
                          Material(
                            borderRadius: BorderRadius.circular(
                                ScreenUtil.instance.setWidth(30.0)),
                            //elevation: 5.0,
                            child: MaterialButton(
                              minWidth: ScreenUtil.instance.setHeight(200.0),
                              height: ScreenUtil.instance.setHeight(50.0),
                              color: Colors.blue,
                              child: Text(
                                "LOGIN",
                                style: TextStyle(
                                  fontSize: ScreenUtil.instance.setSp(16.0),
                                  color: Colors.white,
                                ),
                              ),
                              onPressed: () async {
                                // save the fields..
                                final form = _formKey.currentState;
                                form.save();
                                SharedPreferences prefs =
                                    await SharedPreferences.getInstance();
                                prefs.setString('beepUnit', _beepUnit);
                                print(_beepUnit);
                                // _getLocation();

                                // Validate will return true if is valid, or false if invalid.
                                if (form.validate()) {
                                  try {
                                    FirebaseUser result =
                                        await Provider.of<AuthService>(context)
                                            .loginUser(
                                                email: _email,
                                                password: _password);
                                    print(result);
                                  } on AuthException catch (error) {
                                    return _buildErrorDialog(
                                        context, error.message);
                                  } on Exception catch (error) {
                                    return _buildErrorDialog(
                                        context, error.toString());
                                  }
                                }
                              },
                            ),
                          )
                        ],
                      ),
                    ),
                  ),
                ),
              ),
              SizedBox(
                height: ScreenUtil.instance.setHeight(25.0),
              ),
            ],
          ),
        ),
      ),
    );
  }

  Future _buildErrorDialog(BuildContext context, _message) {
    if (_message == 'Given String is empty or null') {
      _message = 'Please input username and password';
    } else if (_message == 'The email address is badly formatted.') {
      _message = 'Invalid email format.';
    } else if (_message ==
        'There is no user record corresponding to this identifier. The user may have been deleted.') {
      _message = 'User does not exist.';
    } else if (_message == 'An internal error has occurred. [ 7: ]') {
      _message = 'Please check your internet connection.';
    } else {
      _message = 'Please restart the application';
    }
    return showDialog(
      builder: (context) {
        return AlertDialog(
          title: Text('Login Error',
              style: TextStyle(fontWeight: FontWeight.bold)),
          content: Text(_message),
          contentPadding: EdgeInsets.all(24),
          actions: <Widget>[
            FlatButton(
                child: Text('Close'),
                onPressed: () {
                  Navigator.of(context).pop();
                  Navigator.of(context).pushReplacementNamed('/beepunit');
                })
          ],
        );
      },
      context: context,
    );
  }
}
