package com.coche.usc;

import androidx.appcompat.app.AppCompatActivity;

import com.google.firebase.database.DatabaseReference;
import com.google.firebase.database.FirebaseDatabase;

/**
 * Created by Bliss Massage on 04/10/2019.
 */

public class CocheApplication extends AppCompatActivity {

    public static String FBID;
    public static String firstName, lastName;
    public static String companyId;
    public static String serviceType;
    public static String picture;
    public static final String MY_PREFS_NAME = "MyPrefsFile";
    public static String carPlateNumber, carCategory;
    public static String data;

    public static DatabaseReference sendstatus, getLocation;
    public static FirebaseDatabase firebaseDatabase, locationDatabase;
}
