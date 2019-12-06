package usc.cochepartner;

import androidx.appcompat.app.AppCompatActivity;

import android.app.ProgressDialog;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import com.parse.GetCallback;
import com.parse.Parse;
import com.parse.ParseException;
import com.parse.ParseObject;
import com.parse.ParseQuery;
import com.usc.cochepartner.R;

public class LoginActivity extends AppCompatActivity {

    private EditText username, password;
    private Button btnLogin;
    private ProgressDialog pd;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);

        Parse.initialize(new Parse.Configuration.Builder(this)
                .applicationId(getString(R.string.back4app_app_id))
                // if defined
                .clientKey(getString(R.string.back4app_client_key))
                .server(getString(R.string.back4app_server_url))
                .build()
        );


        setupviews();


    }

    private void setupviews() {
        username = findViewById(R.id.edit_username);
        password = findViewById(R.id.edit_password);
        btnLogin = findViewById(R.id.btn_login);

        btnLogin.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                pd = new ProgressDialog(LoginActivity.this);
                pd.setMessage("Please wait, logging in...");
                pd.show();

                if(username.getText().toString().compareTo("")==0 || password.getText().toString().compareTo("")==0){
                    Toast.makeText(LoginActivity.this, "Please please input username and password", Toast.LENGTH_SHORT).show();
                    pd.dismiss();
                }else{
                    ParseQuery<ParseObject> query = ParseQuery.getQuery("Partner");
                    query.whereEqualTo("UserName", username.getText().toString());
                    //query.whereEqualTo("Password", password.getText().toString());
                    query.getFirstInBackground(new GetCallback<ParseObject>() {
                        @Override
                        public void done(final ParseObject objects, ParseException e) {
                            if(e == null){
                                ParseQuery<ParseObject> query1 = ParseQuery.getQuery("Partner");
                                query1.whereEqualTo("Password", password.getText().toString());
                                query1.getFirstInBackground(new GetCallback<ParseObject>() {
                                    @Override
                                    public void done(ParseObject object, ParseException e) {
                                        if(e == null){
                                            if(object.get("Status").equals(0)){
                                                pd.dismiss();
                                                Toast.makeText(LoginActivity.this, "Please wait for approval", Toast.LENGTH_SHORT).show();
                                            }else if(object.get("Status").equals(1)){
                                                pd.dismiss();
                                                CochePartnerApplication.Services = object.getString("Services");
                                                CochePartnerApplication.objectID = object.getObjectId();
                                                CochePartnerApplication.companyName = object.getString("CompanyName");
                                                SharedPreferences.Editor editor = getSharedPreferences(CochePartnerApplication.MY_PREFS_NAME, MODE_PRIVATE).edit();
                                                editor.putString("objectId", objects.getObjectId());
                                                editor.apply();
                                                Toast.makeText(LoginActivity.this, "Successfully Login", Toast.LENGTH_SHORT).show();
                                                Intent intent = new Intent();
                                                intent.setClass(LoginActivity.this, MainActivity.class);
                                                startActivity(intent);
                                                finish();
                                            }else{
                                                pd.dismiss();
                                                Toast.makeText(LoginActivity.this, "You have been denied", Toast.LENGTH_SHORT).show();
                                            }
                                        }else{
                                            pd.dismiss();
                                            Toast.makeText(LoginActivity.this, "No internet connection or Incorrect Password", Toast.LENGTH_SHORT).show();
                                            pd.dismiss();
                                        }
                                    }
                                });

                            }else{
                                Toast.makeText(LoginActivity.this, "No internet connection or Incorrect username", Toast.LENGTH_SHORT).show();
                                pd.dismiss();
                            }
                        }
                    });
                }

            }
        });

    }
}
