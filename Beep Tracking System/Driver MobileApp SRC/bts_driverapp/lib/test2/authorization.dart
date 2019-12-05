import 'package:firebase_auth/firebase_auth.dart';
import 'package:flutter/cupertino.dart';
import 'dart:async';

class AuthService with ChangeNotifier {
  final FirebaseAuth _auth = FirebaseAuth.instance;

  Future<FirebaseUser> getUser() {
    return _auth.currentUser();
  }

  Future logout() async {
    var result = FirebaseAuth.instance.signOut();
    notifyListeners();
    return result;
  }

  Future createUser(
      {String fname, String lname, String email, String password}) async {
    var r = await FirebaseAuth.instance
        .createUserWithEmailAndPassword(email: email, password: password);
    var u = r.user;
    UserUpdateInfo info = UserUpdateInfo();
    info.displayName = '$fname $lname';
    return await u.updateProfile(info);
  }

  Future<FirebaseUser> loginUser({String email, String password}) async {
    try {
      var result = await FirebaseAuth.instance
          .signInWithEmailAndPassword(email: email, password: password);
      notifyListeners();
      return result.user;
    } catch (e) {
      throw new AuthException(e.code, e.message);
    }
  }
}
