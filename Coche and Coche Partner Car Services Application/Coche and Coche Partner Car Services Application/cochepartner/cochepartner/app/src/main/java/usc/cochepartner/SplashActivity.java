package usc.cochepartner;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;
import androidx.core.app.ActivityCompat;
import androidx.core.content.ContextCompat;

import android.Manifest;
import android.app.AlertDialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.SharedPreferences;
import android.content.pm.PackageManager;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.Toast;

import com.google.firebase.database.DatabaseReference;
import com.google.firebase.database.FirebaseDatabase;
import com.parse.GetCallback;
import com.parse.ParseException;
import com.parse.ParseObject;
import com.parse.ParseQuery;
import com.usc.cochepartner.R;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

public class SplashActivity extends AppCompatActivity {


    private Button btnRegister, btnLogin;
    public static final int REQUEST_ID_MULTIPLE_PERMISSIONS = 1;
    FirebaseDatabase database = FirebaseDatabase.getInstance();
    DatabaseReference myRef = database.getReference("message");

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_splash);

        if(checkpermission()){
            setupviews();
        }else{
            checkpermission();
            //Toast.makeText(this, ""+checkpermission(), Toast.LENGTH_SHORT).show();
        }


    }

    private boolean checkpermission() {
        int messagepermission = ContextCompat.checkSelfPermission(this, Manifest.permission.SEND_SMS);
        int receivesms = ContextCompat.checkSelfPermission(this, Manifest.permission.RECEIVE_SMS);


        List<String> listPermissionsNeeded = new ArrayList<>();
//        if (permissionSendMessage != PackageManager.PERMISSION_GRANTED) {
//            listPermissionsNeeded.add(Manifest.permission.SEND_SMS);
//        }
        if(messagepermission != PackageManager.PERMISSION_GRANTED){
            listPermissionsNeeded.add(Manifest.permission.SEND_SMS);
        }

        if (receivesms != PackageManager.PERMISSION_GRANTED){
            listPermissionsNeeded.add(Manifest.permission.RECEIVE_SMS);
        }
        if (!listPermissionsNeeded.isEmpty()) {
            ActivityCompat.requestPermissions(this, listPermissionsNeeded.toArray(new String[listPermissionsNeeded.size()]),REQUEST_ID_MULTIPLE_PERMISSIONS);
            return false;
        }else{
            setupviews();
            return true;
        }
    }


    @Override
    public void onRequestPermissionsResult(int requestCode, @NonNull String[] permissions, @NonNull int[] grantResults) {
        switch (requestCode) {
            case REQUEST_ID_MULTIPLE_PERMISSIONS:
                Map<String, Integer> perms = new HashMap<>();
                // Initialize the map with both permissions
                // perms.put(Manifest.permission.SEND_SMS, PackageManager.PERMISSION_GRANTED);
                perms.put(Manifest.permission.SEND_SMS, PackageManager.PERMISSION_GRANTED);
                perms.put(Manifest.permission.RECEIVE_SMS, PackageManager.PERMISSION_GRANTED);

                if (grantResults.length > 0) {
//                    for (int i = 0; i < permissions.length; i++) {
//                        perms.put(permissions[i], grantResults[i]);
//                    }
                    try{
                        if (perms.get(Manifest.permission.SEND_SMS) == PackageManager.PERMISSION_GRANTED && perms.get(Manifest.permission.RECEIVE_SMS) == PackageManager.PERMISSION_GRANTED) {
                            checkpermission();
                        } else {
                            Toast.makeText(this, "Please Accept all Permissions.", Toast.LENGTH_SHORT).show();
                            //permission is denied (this is the first time, when "never ask again" is not checked) so ask again explaining the usage of permission
//                        // shouldShowRequestPermissionRationale will return true
                            //show the dialog or snackbar saying its necessary and try again otherwise proceed with setup.
                            if (ActivityCompat.shouldShowRequestPermissionRationale(this, Manifest.permission.ACCESS_FINE_LOCATION)) {
                                showDialogOK("SMS and Location Services Permission required for this app",
                                        new DialogInterface.OnClickListener() {
                                            @Override
                                            public void onClick(DialogInterface dialog, int which) {
                                                switch (which) {
                                                    case DialogInterface.BUTTON_POSITIVE:
                                                        checkpermission();
                                                        break;
                                                    case DialogInterface.BUTTON_NEGATIVE:
                                                        // proceed with logic by disabling the related features or quit the app.
                                                        break;
                                                }
                                            }
                                        });
                            }

                        }
                    }catch (Exception e){
                        Log.i("Error", ""+e);
                        Toast.makeText(this, ""+e, Toast.LENGTH_SHORT).show();
                    }

                    break;
                }
        }
    }



    private void showDialogOK(String message, DialogInterface.OnClickListener okListener) {
        new AlertDialog.Builder(this)
                .setMessage(message)
                .setPositiveButton("OK", okListener)
                .setNegativeButton("Cancel", okListener)
                .create()
                .show();
    }


    private void setupviews() {
        btnRegister = findViewById(R.id.btn_register);
        btnLogin = findViewById(R.id.login_button);

        btnRegister.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent();
                intent.setClass(SplashActivity.this, RegisterActivity.class);
                startActivity(intent);
                finish();
            }
        });

        btnLogin.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent();
                intent.setClass(SplashActivity.this, LoginActivity.class);
                startActivity(intent);
                finish();
            }
        });

        SharedPreferences prefs = getSharedPreferences(CochePartnerApplication.MY_PREFS_NAME, MODE_PRIVATE);
        CochePartnerApplication.objectID = prefs.getString("objectId", null);

        if(CochePartnerApplication.objectID != null) {
            Intent intent = new Intent();
            intent.setClass(SplashActivity.this, MainActivity.class);
            startActivity(intent);
            finish();
        }

    }


}
