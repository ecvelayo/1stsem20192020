import 'package:cloud_firestore/cloud_firestore.dart';
import 'package:flutter/material.dart';
import 'package:intl/intl.dart';
import 'package:shared_preferences/shared_preferences.dart'; 

// initializeDateFormatting("fr_FR", null).then((_) => runMyCode());
String uid;

class CommuterLogs extends StatefulWidget{
  @override
  State createState() => CommuterLogsState();
}
  
class CommuterLogsState extends State<CommuterLogs>{

  getToken() async {
    SharedPreferences prefs = await SharedPreferences.getInstance();
    uid = prefs.getString('uid');
  }

    @override
    
    Widget build(BuildContext context){
      // getToken();
      return Scaffold(
        appBar: PreferredSize(
          preferredSize: Size.fromHeight(50),
          child: AppBar(
            title: Text('History', style: TextStyle(color: Colors.white)),
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
        
         body:Container(
           color: Colors.grey[200],
           child: StreamBuilder(
                stream: Firestore.instance.collection('trackedBeep').
                      where('uid', isEqualTo: 'chiekko'). //TODO: change chiekko to uid
                      orderBy('datetime_created', descending: true).snapshots(),
                builder: (context, snapshot){
                    if(snapshot.connectionState == ConnectionState.waiting)
                      return CircularProgressIndicator();
                    
                    return 
                      ListView.builder(
                        itemCount: snapshot.data.documents.length, //length of query
                        itemBuilder: (context, index) {
                          DocumentSnapshot doc = snapshot.data.documents[index];
                          return Container(
                            margin: EdgeInsets.only(bottom: 15),
                            child: Card(
                              elevation: 5,
                              child: Padding(
                                padding: const EdgeInsets.only(top: 8,bottom: 6),
                                child: Column(
                                  children: <Widget>[
                                    Container(
                                      color: Color(0xFFBBD9EE),
                                      child: Row(
                                        mainAxisAlignment: MainAxisAlignment.spaceBetween,
                                        children: <Widget>[
                                          Expanded(
                                            flex: 10,
                                            child: Column(
                                              crossAxisAlignment: CrossAxisAlignment.start,
                                                children: <Widget>[
                                                  Padding(
                                                    padding: const EdgeInsets.all(4.0),
                                                    child: Text(new DateFormat.yMd().add_jm().format(doc['datetime_created'].toDate()), style: TextStyle(color: Colors.white, fontSize: 14, fontWeight: FontWeight.bold),),
                                                  )
                                                  // Text('04:00 AM', style: TextStyle(fontSize: 16)),
                                                ]
                                            ),
                                          ),
                                        ],
                                      ),
                                    ),
                                    Row(
                                      mainAxisAlignment: MainAxisAlignment.spaceEvenly,
                                      children: <Widget>[
                                        Padding(padding: EdgeInsets.fromLTRB(15, 12, 5, 12), child: Column(children: <Widget>[Icon(Icons.directions, color: Colors.yellow[700], size: 22)],)),
                                        Expanded(
                                            child: Column(
                                              crossAxisAlignment: CrossAxisAlignment.start,
                                              children: <Widget>[
                                                Text(doc['busStop'], textAlign: TextAlign.left, style: TextStyle(fontSize: 14)),
                                                // Text('04:00 AM', style: TextStyle(fontSize: 16)),
                                              ],
                                            ),
                                          ),
                                        Padding(padding: EdgeInsets.fromLTRB(0, 12, 5, 12), child: Column(children: <Widget>[Icon(Icons.directions_bus, color: Color(0xFF223172), size: 22)],)),
                                        Expanded(
                                          child: Column(
                                            // align the text to the left instead of centered
                                            crossAxisAlignment: CrossAxisAlignment.start,
                                            children: <Widget>[
                                              Text(doc['beepUnit'].toString(), style: TextStyle(fontSize: 14, color: Colors.black),),
                                              // Text('Beep Unit No.', style: TextStyle(fontSize: 16, color: Colors.black),),
                                            ],
                                          ),
                                        ),
                                        Padding(padding: EdgeInsets.fromLTRB(0, 12, 5, 12), child: Column(children: <Widget>[Icon(Icons.face, color: Colors.black, size: 22)],),),
                                        Expanded(
                                        child: Column(
                                          // align the text to the left instead of centered
                                          crossAxisAlignment: CrossAxisAlignment.start,
                                          children: <Widget>[
                                            Text(doc['driver'], style: TextStyle(fontSize: 14, color: Colors.black)), 
                                            // Text('Driver', style: TextStyle(fontSize: 16, color: Colors.black)), 
                                          ],
                                        ),
                                      )
                                      ],
                                    ),
                                  ],
                                ),
                              ),
                            ),
                          );
                        },
                      );
                    
                }
              
           ),
         )
           );
        //getLogs(),
        // myList(context),
        
    }
}