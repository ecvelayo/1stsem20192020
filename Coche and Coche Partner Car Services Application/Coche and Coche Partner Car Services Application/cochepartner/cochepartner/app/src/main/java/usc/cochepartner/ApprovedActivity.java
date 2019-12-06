package usc.cochepartner;

import androidx.appcompat.app.AppCompatActivity;
import androidx.recyclerview.widget.DefaultItemAnimator;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.TextView;
import android.widget.Toast;

import usc.cochepartner.Adapter.ApprovedAdapter;
import usc.cochepartner.Adapter.BookingAdapter;
import usc.cochepartner.Model.Status;

import com.google.firebase.FirebaseApp;
import com.google.firebase.database.DataSnapshot;
import com.google.firebase.database.DatabaseError;
import com.google.firebase.database.FirebaseDatabase;
import com.google.firebase.database.ValueEventListener;
import com.parse.FindCallback;
import com.parse.Parse;
import com.parse.ParseException;
import com.parse.ParseObject;
import com.parse.ParseQuery;
import com.usc.cochepartner.R;

import java.util.ArrayList;
import java.util.List;

public class ApprovedActivity extends AppCompatActivity {

    private RecyclerView rvBooking;
    private ApprovedAdapter approvedAdapter;
    private LinearLayout linApproved;
    private ImageView imgProfile, imgPending;
    private ImageView btnMain, btnProfile;
    private TextView tvNotification;
    private long count = 0;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_approved);

        Parse.initialize(new Parse.Configuration.Builder(this)
                .applicationId(getString(R.string.back4app_app_id))
                // if defined
                .clientKey(getString(R.string.back4app_client_key))
                .server(getString(R.string.back4app_server_url))
                .build()
        );

        FirebaseApp.initializeApp(this);

        setupviews();
    }

    public void intentpending  (View v){
        Intent intent = new Intent();
        intent.setClass(ApprovedActivity.this, MainActivity.class);
        startActivity(intent);
        finish();
    }

    private void setupviews() {

        rvBooking = findViewById(R.id.rv_booking);
        btnMain = findViewById(R.id.img_main);
        btnProfile = findViewById(R.id.img_logout);
        linApproved = findViewById(R.id.lin_approved);
        imgProfile = findViewById(R.id.img_logout);
        imgPending = findViewById(R.id.img_main);
        tvNotification = findViewById(R.id.tv_notification);

        linApproved.setBackgroundColor(getResources().getColor(R.color.orange));

        tvNotification.setVisibility(View.GONE);

        btnMain.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent();
                intent.setClass(ApprovedActivity.this, MainActivity.class);
                startActivity(intent);
                finish();
            }
        });

        btnProfile.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
//                SharedPreferences settings = getSharedPreferences(CochePartnerApplication.MY_PREFS_NAME, Context.MODE_PRIVATE);
//                settings.edit().clear().commit();
                Intent intent = new Intent();
                intent.setClass(ApprovedActivity.this, ProfileActivity.class);
                startActivity(intent);
                finish();
            }
        });

        imgProfile.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent();
                intent.setClass(ApprovedActivity.this, ProfileActivity.class);
                startActivity(intent);
                finish();
            }
        });

        imgPending.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent();
                intent.setClass(ApprovedActivity.this, MainActivity.class);
                startActivity(intent);
                finish();
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
                Toast.makeText(ApprovedActivity.this, ""+databaseError.getMessage(), Toast.LENGTH_SHORT).show();
            }
        });
        //J pagkuha sa data gkan  sa database
        ParseQuery<ParseObject> query = ParseQuery.getQuery("Reservation");
        query.whereEqualTo("ObjectID", CochePartnerApplication.objectID);
        query.whereEqualTo("Status", "Approved");
        query.findInBackground(new FindCallback<ParseObject>() {
            @Override
            public void done(List<ParseObject> objects, ParseException e) {
                if(e == null){
                    if(objects.size()>0) {
                        for (int i = 0; i < objects.size(); i++) {
                            if(objects.get(i).get("Status").toString().compareTo("Paid") == 0 || objects.get(i).get("Status").toString().compareTo("Approved") == 0) {
                                approvedAdapter = new ApprovedAdapter(ApprovedActivity.this, objects, rvBooking);
                                RecyclerView.LayoutManager mLayoutManager = new LinearLayoutManager(ApprovedActivity.this, LinearLayoutManager.VERTICAL, false);
                                rvBooking.setLayoutManager(mLayoutManager);
                                rvBooking.setItemAnimator(new DefaultItemAnimator());
                                rvBooking.setAdapter(approvedAdapter);
                            }
                        }
                    }
//                    for (int j = 0; j < objects.size(); j++)
//                    {
//                        ParseObject parseObject = objects.get(j);
//                        //fetching data from parseObject
//                    }
                   // Toast.makeText(ApprovedActivity.this, ""+objects.size(), Toast.LENGTH_SHORT).show();
                }else{
                    Toast.makeText(ApprovedActivity.this, ""+e, Toast.LENGTH_SHORT).show();
                }
            }
        });
    }
}
