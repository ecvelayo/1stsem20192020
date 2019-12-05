// import 'package:bts_driverapp/login/homePage.dart';
// import 'package:firebase_auth/firebase_auth.dart';
// import 'package:flutter/material.dart';
// import 'package:provider/provider.dart';
// import 'login/home_page.dart';
// import 'login/auth.dart';
// import 'login/login_page.dart';

// void main() => runApp(
//       ChangeNotifierProvider<AuthService>(
//         child: MyApp(),
//         builder: (BuildContext context) {
//           return AuthService();
//         },
//       ),
//     );

// class MyApp extends StatelessWidget {
//   // This widget is the root of your application.
//   @override
//   Widget build(BuildContext context) {
//     return MaterialApp(
//       title: 'Flutter Demo',
//       theme: ThemeData(primarySwatch: Colors.blue),
//       home: FutureBuilder<FirebaseUser>(
//         future: Provider.of<AuthService>(context).getUser(),
//         builder: (context, AsyncSnapshot<FirebaseUser> snapshot) {
//           if (snapshot.connectionState == ConnectionState.done) {
//             // log error to console
//             if (snapshot.error != null) {
//               print("error");
//               return Text(snapshot.error.toString());
//             }

//             // redirect to the proper page
//             return snapshot.hasData ? DriverHome(snapshot.data) : LoginPage();
//           } else {
//             // show loading indicator
//             return LoadingCircle();
//           }
//         },
//       ),
//     );
//   }
// }

// class LoadingCircle extends StatelessWidget {
//   @override
//   Widget build(BuildContext context) {
//     return Center(
//       child: Container(
//         child: CircularProgressIndicator(),
//         alignment: Alignment(0.0, 0.0),
//       ),
//     );
//   }
// }

import 'package:bts_driverapp/test2/driverHomePage.dart';
import 'package:bts_driverapp/test2/authorization.dart';
import 'package:bts_driverapp/test2/loginPage.dart';
import 'package:firebase_auth/firebase_auth.dart';
import 'package:provider/provider.dart';
import 'package:flutter/material.dart';

void main() => runApp(ChangeNotifierProvider<AuthService>(
      child: MyApp(),
      builder: (BuildContext context) {
        return AuthService();
      },
    ));

class MyApp extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      debugShowCheckedModeBanner: false,
      title: 'Driver Application',
      home: FutureBuilder<FirebaseUser>(
        future: Provider.of<AuthService>(context).getUser(),
        builder: (context, AsyncSnapshot<FirebaseUser> snapshot) {
          if (snapshot.connectionState == ConnectionState.done) {
            if (snapshot.error != null) {
              print('error');
              return Text(snapshot.error.toString());
            }
            return snapshot.hasData
                ? DriverHomePage(snapshot.data)
                : DriverLogin();
          } else {
            return LoadingCircle();
          }
        },
      ),
    );
  }
}

class LoadingCircle extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return Center(
      child: Container(
        child: CircularProgressIndicator(),
        alignment: Alignment(0.0, 0.0),
      ),
    );
  }
}
