import 'package:bts_commuterapp/homePage.dart';
import 'package:cloud_firestore/cloud_firestore.dart';
import 'package:firebase_auth/firebase_auth.dart';
import 'package:flutter/material.dart';
import 'package:shared_preferences/shared_preferences.dart';

class AccountDetails extends StatefulWidget{
  @override
  State createState() => AccountDetailsState();
}
  
class AccountDetailsState extends State<AccountDetails>{

  // String name;
  // String email;
  // String phoneNum;
  // String uid;
  // String type;
  double money;

  getToken() async {

    Firestore.instance.collection('commuter').where('uid', isEqualTo: uid).snapshots().listen((a){
                a.documents.forEach((aa){
                  print('aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');
                  if (money == null){
                  setState(() {
                    money = aa['money'].toDouble();
                  });
               
                }
                  print('bbbbbbbbbbbbbbbbbbbbbbbbbbbbb');
                  print(aa['money']);
                  print('cccccccccccccccccccccccccccccc');
                });
              });


    SharedPreferences prefs =  await SharedPreferences.getInstance();
    name = prefs.getString('name');
    email = prefs.getString('email');
    phoneNum = prefs.getString('phoneNum');
    type = prefs.getString('type');
    // money = prefs.getDouble('money');
    

    print(name);
    print(email);
    print(phoneNum);
    print(type);
    print(money);
    

    FirebaseUser currentUser = await FirebaseAuth.instance.currentUser();
    uid = currentUser.uid;
  }

  removeToken() async {
    SharedPreferences prefs = await SharedPreferences.getInstance();
    prefs.remove('phoneNum');
    print('Dumped');
  }

  requestPremium() async{
    Firestore.instance.collection('requestPremium').document(uid).
    setData({
      'uid': uid,
      'name': name,
      'phone_number': phoneNum,
      // 'request': 'Premium',
      'date': DateTime.now(),
      'status': 1
      });
      alert();
  }

  requestVIP() async{
    Firestore.instance.collection('requestVIP').document(uid).
    setData({
      'uid': uid,
      'name': name,
      'phone_number': phoneNum,
      // 'request': 'VIP',
      'date': DateTime.now(),
      'status': 1
      });
       alert();
  }

  Future<void> alert() async {
    return showDialog<void>(
      context: context,
      barrierDismissible: true,
      builder: (BuildContext context){
        return AlertDialog(
          title: Text('Request Sent! \nAwaiting Confirmation...', textAlign: TextAlign.center),
        );
      }
    );
   
  }

  @override
  Widget build(BuildContext context){
    getToken();
    return Scaffold(
      appBar: PreferredSize(
        preferredSize: Size.fromHeight(50),
        child: AppBar(
          title: Text('Account Details'),
          backgroundColor: Color(0xFF223172),
          elevation: 0,
          leading: IconButton(
            icon:Icon(Icons.arrow_back),
            color: Colors.white,
            onPressed:() {
              Navigator.of(context).pop();
              Navigator.of(context).pushReplacementNamed('/homepage');
            }
          ),
        ),
      ),
    body:
      Column(
        children: <Widget>[
          Padding(
            padding: const EdgeInsets.only(top: 60),
            child: CircleAvatar(
              backgroundColor: Color(0xFF223172),
              backgroundImage: AssetImage('lib/assets/icon/BTSLogo.png'), 
              radius: 50,
            ),
          ),
          SizedBox(height: 60),
          Container(
            
            padding: EdgeInsets.only(left: 50, right: 50),
            alignment: Alignment(-1, 1),
            child: Stack(
              children: <Widget>[
                Row(
                  children: <Widget>[
                    Text('Name: ', textAlign: TextAlign.left,),
                    Text(name??'Loading', textAlign: TextAlign.left,),
                  ],
                ),
                Padding(
                  padding: const EdgeInsets.only(top:20.0),
                  child: Text('Email Address: ' +email??'Loading', textAlign: TextAlign.left),
                ),
                Padding(
                  padding: const EdgeInsets.only(top:40.0),
                  child: Text('Mobile Number: ' +phoneNum??'Loading', textAlign: TextAlign.left),
                ),
                Padding(
                  padding: const EdgeInsets.only(top:60.0),
                  child: Text('Subscription: ' +type??'Loading', textAlign: TextAlign.left),
                ),Padding(
                  padding: const EdgeInsets.only(top:80.0),
                  child: Text('Wallet Balance: ' +money.toString()??'Loading', textAlign: TextAlign.left),
                ),
              ],
            ),
          ),
          
          SizedBox(height: 130),
          Container(
            alignment: Alignment.bottomCenter,
            child: Column(
              children: <Widget>[
                RaisedButton(
                  onPressed: () => requestVIP(),
                  child: Text('GET VIP', style: TextStyle(fontSize: 22, color: Colors.white),),
                  color: Colors.deepPurple[300]
                ),
                RaisedButton(
                  onPressed: () => requestPremium(),
                  child: Text('Get Premium', style: TextStyle(fontSize: 18),),
                  color: Colors.yellow
                ),
                OutlineButton(
                  onPressed: (){
                    removeToken();
                      FirebaseAuth.instance.signOut().then((action) {
                        Navigator.of(context).pushReplacementNamed('/landingpage');
                      }).catchError((e) {
                        print(e);
                      });
                  },
                  child: Text('Logout'),
                  borderSide: BorderSide(
                      // color: Colors.red,
                  )
                )
              ],
            ),
          ),
          
        ]

      ),
            
    );
  }
}