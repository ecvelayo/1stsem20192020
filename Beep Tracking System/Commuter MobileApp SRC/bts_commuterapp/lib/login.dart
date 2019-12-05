import 'package:flutter/material.dart';
import 'package:firebase_auth/firebase_auth.dart';
import 'package:flutter/services.dart';
import 'package:flutter_screenutil/flutter_screenutil.dart';
import 'package:shared_preferences/shared_preferences.dart';
import 'package:cloud_firestore/cloud_firestore.dart';


class Login extends StatefulWidget {
  Login({Key key, this.title}) : super(key: key);
  final String title;

  @override
  LoginState createState() => LoginState();
}

class LoginState extends State<Login> {
  String phoneNo;
  String name;
  String email;
  String smsOTP;
  String verificationId;
  String errorMessage = '';
  final FirebaseAuth _auth = FirebaseAuth.instance;
  final databaseReference = Firestore.instance;
  

  Future<void> verifyPhone() async {
    final PhoneCodeSent smsOTPSent = (String verId, [int forceCodeResend]) {
      this.verificationId = verId;
      smsOTPDialog(context).then((value) {
        print('signing in');
      });
    };
    try {
      await _auth.verifyPhoneNumber(
          phoneNumber: this.phoneNo, // PHONE NUMBER TO SEND OTP
          codeAutoRetrievalTimeout: (String verId) {
            //Starts the phone number verification process for the given phone number.
            //Either sends an SMS with a 6 digit code to the phone number specified, or sign's the user in and [verificationCompleted] is called.
            this.verificationId = verId;
          },
          codeSent:
              smsOTPSent, // WHEN CODE SENT THEN WE OPEN DIALOG TO ENTER OTP.
          timeout: const Duration(seconds: 20),
          verificationCompleted: (AuthCredential phoneAuthCredential) {
            print(phoneAuthCredential);
          },
          verificationFailed: (AuthException exceptio) {
            print('${exceptio.message}');
          });

          //SAVES THE PHONE NUMBER AS TOKEN
          SharedPreferences prefs =  await SharedPreferences.getInstance();
          prefs.setString('name', name);
          prefs.setString('email', email);
          prefs.setString('phoneNum', phoneNo);
          if(phoneNo.contains('+63915')){
            prefs.setString('userType', 'Vip');
          }
          print('saved');
          print(phoneNo);  

    } catch (e) {
      handleError(e);
    }
  }

  Future<bool> smsOTPDialog(BuildContext context) {
    return showDialog(
        context: context,
        barrierDismissible: false,
        builder: (BuildContext context) {
          return Scaffold(
              body: Center(
                child: Container(
                  width: 250.0,
                  child: Padding(
                    padding: const EdgeInsets.only(top: 150.0),
                    child: new Column(
                      // mainAxisAlignment: MainAxisAlignment.center,
                      children: <Widget>[
                        Text('Enter sms Code'),
                        TextField(
                          autofocus: false,
                          textAlign: TextAlign.center,
                          maxLength: 6,
                          keyboardType: TextInputType.phone,
                          onChanged: (value) {
                            this.smsOTP = value;
                          },
                        ),
                        (errorMessage != ''
                          ? Text(
                              errorMessage,
                              style: TextStyle(color: Colors.red),
                            )
                          : Container()),
                        RaisedButton(
                            child: Text('Verify'),
                            textColor: Colors.white,
                            color: Colors.blue,
                            onPressed: () {
                              _auth.currentUser().then((user) {
                              if (user != null) {
                                Navigator.of(context).pop();
                                Navigator.of(context).pushReplacementNamed('/homepage');
                              } else {
                                signIn();
                              }
                              });
                            },
                        ),
                        FlatButton(
                          onPressed: () {
                            verifyPhone();
                          },
                          child: Text('Resend Code'),
                        )
                      ],
                    ),
                  ),
                ),
              ),
          );
        });
  }

  signIn() async {
    try {
      final AuthCredential credential = PhoneAuthProvider.getCredential(
        verificationId: verificationId,
        smsCode: smsOTP,
      );
      final AuthResult user = (await _auth.signInWithCredential(credential));
      // final FirebaseUser currentUser = await _auth.currentUser();
      
      print('aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');
      // assert(user.uid == currentUser.uid);
      print('zzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzz');
      
      // Firestore.instance.collection('commuter').document(currentUser.uid)
      //   .setData({
      //     'uid': currentUser.uid, 
      //     'contact_number': phoneNo, 
      //     'name': name,
      //     'email': email
      //   });
      // String documentid = document.documentID;
      // print(documentid);
      Navigator.of(context).pop();
      Navigator.of(context).pushReplacementNamed('/homepage');
    } catch (e) {
      handleError(e);
    }
  }
  

  handleError(PlatformException error){
    print(error);
    switch (error.code) {
      case 'ERROR_INVALID_VERIFICATION_CODE':
        FocusScope.of(context).requestFocus(new FocusNode());
        setState(() {
          errorMessage = 'Invalid Code';
        });
        Navigator.of(context).pop();
        smsOTPDialog(context).then((value) {
          print('signed in');
        });
        break;
      default:
        setState(() {
          errorMessage = error.message;
        });

        break;
    }
  }
  

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
      resizeToAvoidBottomInset: false,
      body: Container(
        decoration: BoxDecoration(
          color: const Color(0xFF223172)
        ),
        child: Center(
          child: ListView(
            
            children: <Widget>[
              Container(
                padding: EdgeInsets.only(top: (35.0)),
                child: Container(
                  height:ScreenUtil.instance.setHeight(180.0),
                  width:ScreenUtil.instance.setWidth(180.0),
                  decoration: BoxDecoration(
                    image: DecorationImage(
                      image: AssetImage('lib/assets/icon/BTSLogo.png'),
                      fit: BoxFit.contain
                    ),
                  ),
                  child: Align(
                    alignment: Alignment (0.0, 0.875),
                      child: Text(
                        'BEEP TRACKING SYSTEM',
                        textAlign: TextAlign.center,
                        style: TextStyle(
                          fontSize: ScreenUtil.instance.setSp(15.0),
                          color: Colors.white
                        ),
                      ),
                    ),
                ),
              ),

              Padding(
                padding: EdgeInsets.fromLTRB(80, 20, 80, 0),
                child: Card(
                  child: Column(
                    children: <Widget>[
                      Padding(
                        padding: const EdgeInsets.fromLTRB(25.0, 0.0, 25.0, 0.0),
                        child: TextField(
                          autofocus: false,
                          textAlign: TextAlign.center,
                          keyboardType: TextInputType.text,
                          decoration: InputDecoration(
                            hintText: 'Full Name'
                          ),
                          onChanged: (value) {
                            this.name = value;
                          },
                    ),
                      ),
                    ],
                  ),
                ),
              ),

              Padding(
                padding: EdgeInsets.fromLTRB(80, 0, 80, 0),
                child: Card(
                  child: Column(
                    children: <Widget>[
                      Padding(
                        padding: const EdgeInsets.fromLTRB(25.0, 0.0, 25.0, 0.0),
                        child: TextField(
                          autofocus: false,
                          textAlign: TextAlign.center,
                          keyboardType: TextInputType.emailAddress,
                          decoration: InputDecoration(
                            hintText: 'Email Address'
                          ),
                          onChanged: (value) {
                            this.email = value;
                          },
                    ),
                      ),
                    ],
                  ),
                ),
              ),
              
              Padding(
                padding: EdgeInsets.only(left: 80, right: 80, top: 5, bottom: 20),
                child: Card(
                  child:Column(
                    children: <Widget>[
                      Padding(
                        padding: const EdgeInsets.fromLTRB(8.0,8.0,8.0,2.0),
                        child: Align(
                          alignment: Alignment.centerLeft,
                          child: Text(
                            'PHONE NUMBER:',
                            style: TextStyle(fontSize: ScreenUtil.instance.setSp(12.0), color: Color(0xFF223172)) ,
                          ),
                        ),
                      ),
                      Padding(
                        padding: const EdgeInsets.fromLTRB(25.0, 0.0, 25.0, 10.0),
                        child: TextField(
                          autofocus: false,
                          textAlign: TextAlign.center,
                          keyboardType: TextInputType.phone,
                          maxLength: 13,
                          decoration: InputDecoration(
                            hintText: '+63xxx xxx xxxx'
                          ),
                          onChanged: (value) {
                            this.phoneNo = value;
                          },
                    ),
                      ),
                    ], 
                  ),
                ),
              ),
              (errorMessage != ''
                  ? Text(
                      errorMessage,
                      style: TextStyle(color: Colors.red),
                    )
                  : Container()),

              SizedBox(
                height: ScreenUtil.instance.setHeight(0),
              ),

              Column(
                children: <Widget>[
                  SizedBox(
                    width: MediaQuery.of(context).size.width*0.55,
                      child: RaisedButton(
                      onPressed: () {
                        verifyPhone();
                      },
                      child: Text('PROCEED'),
                      textColor: Color(0xFF223172),
                      elevation: 7,
                      color: Color(0xFFFFD64E),
                    ),
                  ),
                ],
              )

            ],
          ),
        ),
      ),
    );
  }
}

  