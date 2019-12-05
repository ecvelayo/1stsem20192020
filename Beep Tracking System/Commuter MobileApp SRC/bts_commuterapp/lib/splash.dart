import 'dart:async';

import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:flutter/services.dart';
import 'package:shared_preferences/shared_preferences.dart';

class SplashScreen extends StatefulWidget{
  @override
  State createState() => SplashScreenState();

}

class SplashScreenState extends State<SplashScreen>{

  final int splashDuration = 5;

  @override
    void initState() {
      super.initState();
      countDownTime();
    }

    checkToken() async {
      SharedPreferences prefs =  await SharedPreferences.getInstance();
        var phoneNum = prefs.getString('phoneNum');
        print(phoneNum);
        phoneNum != null ? 
          Navigator.of(context).pushReplacementNamed('/homepage') 
          : Navigator.of(context).pushReplacementNamed('/landingpage');
    }
      
        countDownTime() async {
        return Timer(
            Duration(seconds: splashDuration),
                () {
              SystemChannels.textInput.invokeMethod('TextInput.hide');
              checkToken();
            }
        );
      }
      
        @override
        Widget build(BuildContext context) {
          return Scaffold(
            body: Container(
              decoration: BoxDecoration(
                color: const Color(0xFF223172)
                // gradient: LinearGradient(begin: Alignment.topRight, end: Alignment.bottomLeft, colors: [Colors.blue[900], Colors.blue])
              ),
              child: Center(
                child: Column(
                  mainAxisAlignment: MainAxisAlignment.center,
                  children: <Widget>[
                      Column(
                          children: <Widget>[
                            Container(
                              height: 300.0,
                              width: 300.0,
                              decoration: BoxDecoration(
                                image: DecorationImage(
                                  image: AssetImage('lib/assets/icon/BTSLogo.png'),
                                  fit: BoxFit.fitWidth
                                  ),  
                              ),
      
                              child: Align(
                              alignment: Alignment (0.0, 0.725),
                                child: Text(
                                  'BEEP TRACKING SYSTEM',
                                  textAlign: TextAlign.center,
                                  style: TextStyle(
                                    fontSize: 15.0,
                                    color: Colors.white
                                  ),
                                ),
                              ),
                            ),
                          ] 
                      ),
                  ],
                ),
              ),
            ),
          );
        }
}