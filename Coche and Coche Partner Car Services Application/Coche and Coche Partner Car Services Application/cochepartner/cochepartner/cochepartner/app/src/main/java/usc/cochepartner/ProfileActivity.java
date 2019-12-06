package usc.cochepartner;

import androidx.appcompat.app.AlertDialog;
import androidx.appcompat.app.AppCompatActivity;
import androidx.recyclerview.widget.DefaultItemAnimator;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import android.app.ProgressDialog;
import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.RelativeLayout;
import android.widget.Spinner;
import android.widget.TextView;
import android.widget.Toast;

import com.bumptech.glide.Glide;
import com.google.firebase.database.DataSnapshot;
import com.google.firebase.database.DatabaseError;
import com.google.firebase.database.FirebaseDatabase;
import com.google.firebase.database.ValueEventListener;
import com.parse.FindCallback;
import com.parse.GetCallback;
import com.parse.Parse;
import com.parse.ParseException;
import com.parse.ParseObject;
import com.parse.ParseQuery;
import com.parse.SaveCallback;
import com.usc.cochepartner.R;

import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Calendar;
import java.util.Date;
import java.util.List;

import usc.cochepartner.Adapter.TransactionAdapter;

public class ProfileActivity extends AppCompatActivity {

    private LinearLayout linProfile;
    private ImageView btnLogout, btnAdd, btnEdit;
    private EditText name, email, number;
    private Button btnSave;
    private RecyclerView rvTransaction;
    private ArrayList<String> services = new ArrayList<>();
    private TransactionAdapter transactionAdapter;
    private ProgressDialog pd;
    private RelativeLayout noTransaction;
    private ImageView imgApproved, imgPending;
    private TextView tvNotification;
    private long count = 0;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_profile);

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
        linProfile = findViewById(R.id.lin_profile);
        btnLogout = findViewById(R.id.btn_logout);
        btnAdd = findViewById(R.id.btn_add);
        name = findViewById(R.id.tv_name);
        email = findViewById(R.id.tv_email);
        number = findViewById(R.id.tv_number);
        btnEdit = findViewById(R.id.btn_edit);
        btnSave = findViewById(R.id.btn_save);
        rvTransaction = findViewById(R.id.rv_transactions);
        noTransaction = findViewById(R.id.no_layout);
        imgApproved = findViewById(R.id.img_reserve);
        imgPending = findViewById(R.id.img_main);
        tvNotification = findViewById(R.id.tv_notification);

        if(CochePartnerApplication.Services.compareToIgnoreCase("Towing")==0){
            btnAdd.setVisibility(View.GONE);
        }

        pd = new ProgressDialog(ProfileActivity.this);
        pd.setMessage("Please wait, Retrieving Information");
        pd.show();

        name.setEnabled(false);
        number.setEnabled(false);
        email.setEnabled(false);

        linProfile.setBackgroundColor(getResources().getColor(R.color.orange));

        //D pagkuha sa data gikan sa database
        ParseQuery<ParseObject> query = ParseQuery.getQuery("Partner");
        query.whereEqualTo("objectId", CochePartnerApplication.objectID);
        query.getFirstInBackground(new GetCallback<ParseObject>() {
            @Override
            public void done(ParseObject object, ParseException e) {
                if (e == null) {
                    name.setText(""+object.getString("CompanyName"));
                    email.setText(""+object.getString("Email"));
                    number.setText(""+object.getString("Number"));
                    pd.dismiss();
                }else{
                    Toast.makeText(ProfileActivity.this, "No Internet Connection", Toast.LENGTH_SHORT).show();
                    pd.dismiss();
                }
            }
        });

        //D pagkuha sa data gikan sa database
        ParseQuery<ParseObject> query1 = ParseQuery.getQuery("Reservation");
        query1.whereEqualTo("ObjectID", CochePartnerApplication.objectID);
        query1.whereEqualTo("Status", "Approved");
        query1.orderByDescending("createdAt");
        query1.findInBackground(new FindCallback<ParseObject>() {
            @Override
            public void done(List<ParseObject> objects, ParseException e) {
                if(e == null){
                    noTransaction.setVisibility(View.GONE);
                    rvTransaction.setVisibility(View.VISIBLE);
                    transactionAdapter = new TransactionAdapter(ProfileActivity.this, objects);
                    RecyclerView.LayoutManager mLayoutManager = new LinearLayoutManager(ProfileActivity.this, LinearLayoutManager.VERTICAL, false);
                    rvTransaction.setLayoutManager(mLayoutManager);
                    rvTransaction.setItemAnimator(new DefaultItemAnimator());
                    rvTransaction.setAdapter(transactionAdapter);
                }else{
                    Toast.makeText(ProfileActivity.this, "No Internet Connection or No transactions", Toast.LENGTH_SHORT).show();

                }
            }
        });

        btnEdit.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                name.setEnabled(true);
                email.setEnabled(true);
                number.setEnabled(true);
                btnSave.setVisibility(View.VISIBLE);
            }
        });

        btnSave.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Date c = Calendar.getInstance().getTime();
                System.out.println("Current time => " + c);

                pd.setMessage("Updating Information...");
                pd.show();

                SimpleDateFormat df = new SimpleDateFormat("dd-MMM-yyyy hh:mm aaa");
                final String updatedAt = df.format(c);

                ParseQuery<ParseObject> query = ParseQuery.getQuery("Partner");
                query.whereEqualTo("objectId", CochePartnerApplication.objectID);
                query.getFirstInBackground(new GetCallback<ParseObject>() {
                    @Override
                    public void done(ParseObject object, ParseException e) {
                        if(e == null){
                            object.put("CompanyName", name.getText().toString());
                            object.put("Email", email.getText().toString());
                            object.put("Number", number.getText().toString());
                            object.put("updated_at", updatedAt);
                            object.saveInBackground(new SaveCallback() {
                                @Override
                                public void done(ParseException e) {
                                    if(e == null){
                                        name.setEnabled(false);
                                        email.setEnabled(false);
                                        number.setEnabled(false);
                                        btnSave.setVisibility(View.GONE);
                                        Toast.makeText(ProfileActivity.this, "Successfully Updated", Toast.LENGTH_SHORT).show();
                                        pd.dismiss();
                                    }else{
                                        Toast.makeText(ProfileActivity.this, "No Internet Connection", Toast.LENGTH_SHORT).show();
                                    }
                                }
                            });
                        }else{
                            Toast.makeText(ProfileActivity.this, "No Internet Connection", Toast.LENGTH_SHORT).show();
                        }
                    }
                });
            }
        });

        CochePartnerApplication.firebaseDatabase = FirebaseDatabase.getInstance();
        CochePartnerApplication.sendstatus = CochePartnerApplication.firebaseDatabase.getReference("Reservation").child(CochePartnerApplication.objectID);
        CochePartnerApplication.sendstatus.addValueEventListener(new ValueEventListener() {
            @Override
            public void onDataChange(DataSnapshot dataSnapshot) {
                for (DataSnapshot childkey : dataSnapshot.getChildren()) {
                    childkey.getKey();
                    if(childkey.child("FBUSER").getValue() != null){
                        count = dataSnapshot.getChildrenCount();
                        tvNotification.setVisibility(View.VISIBLE);
                        tvNotification.setText(""+count);
                    }
                }
            }
            @Override
            public void onCancelled(DatabaseError databaseError) {
                Log.e("Database: ", ""+databaseError.getMessage());
                Toast.makeText(ProfileActivity.this, ""+databaseError.getMessage(), Toast.LENGTH_SHORT).show();
            }
        });


        btnLogout.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                SharedPreferences settings = getSharedPreferences(CochePartnerApplication.MY_PREFS_NAME, Context.MODE_PRIVATE);
                settings.edit().clear().commit();
                Intent intent = new Intent();
                intent.setClass(ProfileActivity.this, SplashActivity.class);
                startActivity(intent);
                finish();
            }
        });

        imgApproved.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent();
                intent.setClass(ProfileActivity.this, ApprovedActivity.class);
                startActivity(intent);
                finish();
            }
        });

        imgPending.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent();
                intent.setClass(ProfileActivity.this, MainActivity.class);
                startActivity(intent);
                finish();
            }
        });

        btnAdd.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                inflatelayout();
            }
        });

    }

    private void inflatelayout() {
        LayoutInflater factory = LayoutInflater.from(this);
        final View dialog = factory.inflate(R.layout.dialog_service, null);
        final AlertDialog dialoglayout = new AlertDialog.Builder(this, R.style.MyDialogTheme).create();
        dialoglayout.setView(dialog);

        final Spinner service = dialog.findViewById(R.id.spinner_services);
        Button btnSubmit = dialog.findViewById(R.id.btn_submit);

        services.clear();

        if(CochePartnerApplication.Services.compareToIgnoreCase("Repair")==0){
            services.add("OverHaul");
            services.add("Engine Failure");
        }else{
            services.add("Engine Wash");
            services.add("Full Body Wash");
        }

        ArrayAdapter<String> adapter = new ArrayAdapter<>(this, android.R.layout.simple_spinner_dropdown_item, services);
        service.setAdapter(adapter);

        btnSubmit.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                //D pagbutang sa data padung sa database
                ParseObject carService = new ParseObject("Services");
                carService.put("ServiceName", service.getSelectedItem().toString());
                carService.put("ObjectID", CochePartnerApplication.objectID);
                carService.saveInBackground(new SaveCallback() {
                    @Override
                    public void done(ParseException e) {
                        if(e == null){
                            Toast.makeText(ProfileActivity.this, "Successfully Added", Toast.LENGTH_SHORT).show();
                            dialoglayout.dismiss();
                        }else{
                            Toast.makeText(ProfileActivity.this, "No Internet Connection", Toast.LENGTH_SHORT).show();
                        }
                    }
                });
            }
        });

        dialoglayout.show();
    }
}
