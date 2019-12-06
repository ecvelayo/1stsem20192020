package com.coche.usc.activity;

import android.Manifest;
import android.app.AlertDialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.SharedPreferences;
import android.content.pm.PackageManager;
import android.graphics.Bitmap;
import android.graphics.drawable.BitmapDrawable;
import android.graphics.drawable.Drawable;
import android.net.Uri;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.Toast;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;
import androidx.core.app.ActivityCompat;
import androidx.core.content.ContextCompat;

import com.coche.usc.CocheApplication;
import com.facebook.AccessToken;
import com.facebook.AccessTokenTracker;
import com.facebook.CallbackManager;
import com.facebook.FacebookCallback;
import com.facebook.FacebookException;
import com.facebook.FacebookSdk;
import com.facebook.GraphRequest;
import com.facebook.GraphResponse;
import com.facebook.login.LoginResult;
import com.facebook.login.widget.LoginButton;
import com.google.android.gms.common.SignInButton;
import com.parse.GetCallback;
import com.parse.Parse;
import com.parse.ParseException;
import com.parse.ParseObject;
import com.parse.ParseQuery;

import org.json.JSONObject;

import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Arrays;
import java.util.Calendar;
import java.util.Date;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

import co.coche.usc.R;

public class SplashActivity extends AppCompatActivity {

    private ImageView imgSplash;
    private LoginButton fbLogin;
    private SignInButton gooleLogin;
    private String strData;

    private CallbackManager callbackManager;

    public static final int REQUEST_ID_MULTIPLE_PERMISSIONS = 1;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_splash);

        callbackManager = CallbackManager.Factory.create();

        imgSplash = findViewById(R.id.img_splash);
        fbLogin = findViewById(R.id.login_button);
        gooleLogin = findViewById(R.id.sign_in_button);

        fbLogin.setReadPermissions("public_profile", "email", "user_friends");

        Parse.initialize(new Parse.Configuration.Builder(this)
                .applicationId(getString(R.string.back4app_app_id))
                // if defined
                .clientKey(getString(R.string.back4app_client_key))
                .server(getString(R.string.back4app_server_url))
                .build()
        );
        
        if(checkpermission()){
            process();
        }else{
            checkpermission();
            process();
        }
        

    }

    private void process() {
        //Toast.makeText(this, ""+createdAt, Toast.LENGTH_SHORT).show();

        Uri data = getIntent().getData();
        if(data != null)
        {
            strData = data.toString();

        }


        fbLogin.registerCallback(callbackManager, new FacebookCallback<LoginResult>() {
            @Override
            public void onSuccess(LoginResult loginResult) {

            }

            @Override
            public void onCancel() {

            }

            @Override
            public void onError(FacebookException error) {
                Toast.makeText(SplashActivity.this, ""+error, Toast.LENGTH_SHORT).show();
            }
        });

        SharedPreferences prefs = getSharedPreferences(CocheApplication.MY_PREFS_NAME, MODE_PRIVATE);
        CocheApplication.FBID = prefs.getString("fbId", null);

        if(CocheApplication.FBID != null && strData == null){
            Intent intent = new Intent();
            intent.setClass(SplashActivity.this, MainActivity.class);
            startActivity(intent);
            finish();
        }else if(CocheApplication.FBID != null && strData != null){
            CocheApplication.data = strData;
            Intent intent = new Intent();
            intent.setClass(SplashActivity.this, CarwashActivity.class);
            startActivity(intent);
            finish();
        }


//        fbLogin.setOnClickListener(new View.OnClickListener() {
//            @Override
//            public void onClick(View view) {
//                Intent intent = new Intent(SplashActivity.this, MainActivity.class);
//                intent.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK | Intent.FLAG_ACTIVITY_CLEAR_TASK);
//                startActivity(intent);
//                finish();
//                overridePendingTransition(R.anim.slide_in_right, R.anim.slide_out_left);
//            }
//        });

        AccessTokenTracker accessTokenTracker = new AccessTokenTracker() {
            @Override
            protected void onCurrentAccessTokenChanged(AccessToken oldAccessToken, AccessToken currentAccessToken) {
                if (currentAccessToken == null){
                    //Toast.makeText(SplashActivity.this, ""+currentAccessToken, Toast.LENGTH_SHORT).show();
                }else{
                    if(!(SplashActivity.this).isFinishing()){

                        //Toast.makeText(LoginActivity.this, ""+Constants.accessToken, Toast.LENGTH_SHORT).show();
                        getprofileId(currentAccessToken);

                    }else{
                        //Toast.makeText(LoginActivity.this, ""+Constants.accessToken, Toast.LENGTH_SHORT).show();
                        getprofileId(currentAccessToken);
                    }

                }
            }
        };


        gooleLogin.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent(SplashActivity.this, MainActivity.class);
                intent.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK | Intent.FLAG_ACTIVITY_CLEAR_TASK);
                startActivity(intent);
                finish();
                overridePendingTransition(R.anim.slide_in_right, R.anim.slide_out_left);
            }
        });

        imgSplash.setImageResource(0);
        Drawable draw = getResources().getDrawable(R.drawable.img_splash);
        draw = resize(draw);
        imgSplash.setImageDrawable(draw);

//        new Handler().postDelayed(new Runnable() {
//            @Override
//            public void run() {
//
//                Intent intent = new Intent(SplashActivity.this, MainActivity.class);
//                intent.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK | Intent.FLAG_ACTIVITY_CLEAR_TASK);
//                startActivity(intent);
//                finish();
//                overridePendingTransition(R.anim.slide_in_right, R.anim.slide_out_left);
//
//            }
//        }, 3000);
    }

    private boolean checkpermission() {

        int callpermission = ContextCompat.checkSelfPermission(this, Manifest.permission.CALL_PHONE);
        int messagepermission = ContextCompat.checkSelfPermission(this, Manifest.permission.SEND_SMS);
        int receivesms = ContextCompat.checkSelfPermission(this, Manifest.permission.RECEIVE_SMS);
        int locationpermission = ContextCompat.checkSelfPermission(this, Manifest.permission.ACCESS_FINE_LOCATION);
        int locationpermission1 = ContextCompat.checkSelfPermission(this, Manifest.permission.ACCESS_COARSE_LOCATION);

        List<String> listPermissionsNeeded = new ArrayList<>();

        if (callpermission != PackageManager.PERMISSION_GRANTED) {
            listPermissionsNeeded.add(Manifest.permission.CALL_PHONE);
        }
//        if (permissionSendMessage != PackageManager.PERMISSION_GRANTED) {
//            listPermissionsNeeded.add(Manifest.permission.SEND_SMS);
//        }
        if(messagepermission != PackageManager.PERMISSION_GRANTED){
            listPermissionsNeeded.add(Manifest.permission.SEND_SMS);
        }
        if (locationpermission != PackageManager.PERMISSION_GRANTED){
            listPermissionsNeeded.add(Manifest.permission.ACCESS_FINE_LOCATION);
        }
        if (locationpermission1 != PackageManager.PERMISSION_GRANTED){
            listPermissionsNeeded.add(Manifest.permission.ACCESS_COARSE_LOCATION);
        }
        if (receivesms != PackageManager.PERMISSION_GRANTED){
            listPermissionsNeeded.add(Manifest.permission.RECEIVE_SMS);
        }
        if (!listPermissionsNeeded.isEmpty()) {
            ActivityCompat.requestPermissions(this, listPermissionsNeeded.toArray(new String[listPermissionsNeeded.size()]),REQUEST_ID_MULTIPLE_PERMISSIONS);
            return false;
        }else{
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
                perms.put(Manifest.permission.CALL_PHONE, PackageManager.PERMISSION_GRANTED);
                perms.put(Manifest.permission.SEND_SMS, PackageManager.PERMISSION_GRANTED);
                perms.put(Manifest.permission.RECEIVE_SMS, PackageManager.PERMISSION_GRANTED);
                perms.put(Manifest.permission.ACCESS_FINE_LOCATION, PackageManager.PERMISSION_GRANTED);
                perms.put(Manifest.permission.ACCESS_COARSE_LOCATION, PackageManager.PERMISSION_GRANTED);
                if (grantResults.length > 0) {
                    for (int i = 0; i < permissions.length; i++) {
                        perms.put(permissions[i], grantResults[i]);
                    }

                    try{
                        if (perms.get(Manifest.permission.SEND_SMS) == PackageManager.PERMISSION_GRANTED && perms.get(Manifest.permission.CALL_PHONE) == PackageManager.PERMISSION_GRANTED
                        && perms.get(Manifest.permission.RECEIVE_SMS) == PackageManager.PERMISSION_GRANTED && perms.get(Manifest.permission.ACCESS_FINE_LOCATION) == PackageManager.PERMISSION_GRANTED &&
                                perms.get(Manifest.permission.ACCESS_COARSE_LOCATION) == PackageManager.PERMISSION_GRANTED ) {
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

    private void getprofileId(AccessToken currentAccessToken) {
        GraphRequest graphRequest = GraphRequest.newMeRequest(currentAccessToken, new GraphRequest.GraphJSONObjectCallback() {
            @Override
            public void onCompleted(JSONObject object, GraphResponse response) {
                try {
                    CocheApplication.FBID = object.getString("id");
                    CocheApplication.firstName = object.getString("first_name");
                    CocheApplication.lastName = object.getString("last_name");
                    
                    checkuser(object.getString("id"));
                    //Toast.makeText(SplashActivity.this, ""+object.getString("first_name"), Toast.LENGTH_SHORT).show();
                    //loggingin(object.getString("email"));
                    CocheApplication.picture = "https://graph.facebook.com/"+ CocheApplication.FBID+ "/picture?type=normal";
                    //Toast.makeText(SplashActivity.this, ""+object.getString("email"), Toast.LENGTH_SHORT).show();
//                    Intent intent = new Intent(SplashActivity.this, AdditionalInfoActivity.class);
//                    intent.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK | Intent.FLAG_ACTIVITY_CLEAR_TASK);
//                    startActivity(intent);
//                    finish();
//                    overridePendingTransition(R.anim.slide_in_right, R.anim.slide_out_left);

                }catch (Exception e){
                    Toast.makeText(SplashActivity.this, "Error "+e, Toast.LENGTH_SHORT).show();
                }
            }
        });

        Bundle parameters = new Bundle();
        parameters.putString("fields", "first_name,last_name,email,id");
        graphRequest.setParameters(parameters);
        graphRequest.executeAsync();
    }

    private void checkuser(final String id) {
        ParseQuery<ParseObject> query = ParseQuery.getQuery("Users");
        query.whereEqualTo("FBID", id);
        //query.whereEqualTo("Password", password.getText().toString());
        query.getFirstInBackground(new GetCallback<ParseObject>() {
            @Override
            public void done(ParseObject objects, ParseException e) {
                if(e == null){
                    SharedPreferences.Editor editor = getSharedPreferences(CocheApplication.MY_PREFS_NAME, MODE_PRIVATE).edit();
                    editor.putString("fbId", id);
                    editor.apply();
                    Intent intent = new Intent(SplashActivity.this, MainActivity.class);
                    intent.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK | Intent.FLAG_ACTIVITY_CLEAR_TASK);
                    startActivity(intent);
                    finish();
                    overridePendingTransition(R.anim.slide_in_right, R.anim.slide_out_left);

                }else{
                    //Toast.makeText(SplashActivity.this, ""+e, Toast.LENGTH_SHORT).show();
                    Intent intent = new Intent(SplashActivity.this, AdditionalInfoActivity.class);
                    intent.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK | Intent.FLAG_ACTIVITY_CLEAR_TASK);
                    startActivity(intent);
                    finish();
                    overridePendingTransition(R.anim.slide_in_right, R.anim.slide_out_left);
                }
            }
        });
    }

    @Override
    protected void onActivityResult(int requestCode, int resultCode, Intent data) {
        super.onActivityResult(requestCode, resultCode, data);
        if(resultCode == RESULT_OK){
            //Toast.makeText(this, "ok" +requestCode+" "+resultCode+" "+data, Toast.LENGTH_SHORT).show();
            callbackManager.onActivityResult(requestCode, resultCode, data);
        }
//        if(requestCode == RC_SIGN_IN){
//            Task<GoogleSignInAccount> task = GoogleSignIn.getSignedInAccountFromIntent(data);
//            handleSignInResult(task);
//        }else{
//        Toast.makeText(this, ""+resultCode+" "+requestCode+" "+data, Toast.LENGTH_SHORT).show();

            //Toast.makeText(this, ""+requestCode+" "+resultCode+" "+data, Toast.LENGTH_SHORT).show();
 //       }
    }


    private Drawable resize(Drawable image) {
        Bitmap bitmap = ((BitmapDrawable) image).getBitmap();
        Bitmap bitmapResized = Bitmap.createScaledBitmap(bitmap,
                (int) (bitmap.getWidth() * 0.5), (int) (bitmap.getHeight() * 0.5), false);
        return new BitmapDrawable(getResources(), bitmapResized);
    }
}
