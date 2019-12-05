// import 'dart:async';
// import 'package:flutter/material.dart';
// import 'package:flutter_launcher_icons/main.dart';
// import 'login_page.dart';
// import 'Firemap.dart'; //-----------------take down later, transfer to login_page.dart

// import 'package:cloud_firestore/cloud_firestore.dart';
// import 'package:firebase_auth/firebase_auth.dart';
// import 'package:cloud_firestore/cloud_firestore.dart';
// import 'package:firebase_analytics/firebase_analytics.dart';
// import 'package:firebase_core/firebase_core.dart';s



//gradle-wrapper.properties
//distributionUrl=https\://services.gradle.org/distributions/gradle-5.4.1-all.zip

//build.gradle\android
//dependencies {
        // classpath 'com.android.tools.build:gradle:3.5.0'
        // classpath 'com.google.gms:google-services:4.3.2'
// dependencies {
//     implementation 'com.google.firebase:firebase-analytics:17.2.0'
//add at the end 
        //apply plugin: 'com.google.gms.google-services'

//AndroidManifest.xml
        //<uses-permission android:name="android.permission.ACCESS_FINE_LOCATION" />
        //<uses-permission android:name="android.permission.ACCESS_COARSE_LOCATION" />
        //<meta-data android:name="com.google.android.geo.API_KEY"
               //android:value="AIzaSyDrQb-Xy9Ijp_QrAiFnlVpQp8H5mrUbBl4"/>

// void main() => runApp(MyApp());

// class MyApp extends StatelessWidget {
//   @override
//   Widget build(BuildContext context) {
//     return MaterialApp(
//         home: Scaffold(
//           body: LandingPage()//FireMap()
//       )
//     );
//   }
// }


import 'package:bts_commuterapp/accountDetails.dart';
import 'package:bts_commuterapp/commuterLogs.dart';
import 'package:bts_commuterapp/homePage.dart';
// import 'package:bts_commuterapp/homePage.dart' as prefix0;
import 'package:bts_commuterapp/splash.dart';
import 'package:flutter/material.dart';
import 'landingPage.dart';
// import 'login/app.dart';
import 'login.dart';
// import 'map/main_map.dart';

void main() => runApp(BtsApp());

class BtsApp extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      routes: <String, WidgetBuilder>{
        '/splashpage': (BuildContext context) => SplashScreen(),
        '/landingpage': (BuildContext context) => LandingPage(),
        '/homepage': (BuildContext context) => HomeMap(),
        '/loginpage': (BuildContext context) => Login(),
        '/accountDetails': (BuildContext context) => AccountDetails(),
        '/commuterLogs': (BuildContext context) => CommuterLogs(),
      },
      theme: ThemeData(
        primarySwatch: Colors.blue,
      ),
      home: SplashScreen(),
    );
  }
}