package usc.cochepartner;

import android.app.Application;

import androidx.appcompat.app.AppCompatActivity;

import com.google.firebase.database.DatabaseReference;
import com.google.firebase.database.FirebaseDatabase;

public class CochePartnerApplication extends AppCompatActivity {

    public static String objectID;
    public static String companyName;
    public static final String MY_PREFS_NAME = "MyPrefsFile";
    public static String Services;

    public static DatabaseReference sendstatus, getLocation;
    public static FirebaseDatabase firebaseDatabase, locationDatabase;
}
