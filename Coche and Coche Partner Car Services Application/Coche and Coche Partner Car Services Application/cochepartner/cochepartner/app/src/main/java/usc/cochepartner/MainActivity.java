package usc.cochepartner;

import androidx.appcompat.app.AppCompatActivity;
import androidx.recyclerview.widget.DefaultItemAnimator;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;
import androidx.swiperefreshlayout.widget.SwipeRefreshLayout;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.telephony.SmsManager;
import android.util.Log;
import android.view.View;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.RelativeLayout;
import android.widget.TextView;
import android.widget.Toast;

import usc.cochepartner.Adapter.BookingAdapter;
import usc.cochepartner.Model.Status;

import com.google.firebase.FirebaseApp;
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
import com.usc.cochepartner.R;

import java.util.List;

public class MainActivity extends AppCompatActivity {

    private RecyclerView rvBooking;
    private BookingAdapter bookingAdapter;
    private RelativeLayout linReserve;
    private SwipeRefreshLayout swipeRefreshLayout;


    private ImageView btnreserve, btnProfile;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

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

    private void setupviews() {

        rvBooking = findViewById(R.id.rv_booking);
        btnreserve = findViewById(R.id.img_reserve);
        btnProfile = findViewById(R.id.img_profile);
        linReserve = findViewById(R.id.lin_reserve);
        swipeRefreshLayout = findViewById(R.id.refreshlayout);


        linReserve.setBackgroundColor(getResources().getColor(R.color.orange));

        ParseQuery<ParseObject> query1 = ParseQuery.getQuery("Partner");
        query1.whereEqualTo("objectId", CochePartnerApplication.objectID);
        query1.getFirstInBackground(new GetCallback<ParseObject>() {
            @Override
            public void done(ParseObject object, ParseException e) {
                if(e == null ){
                    CochePartnerApplication.Services = object.getString("Services");
                    process();
                }else{
                    Toast.makeText(MainActivity.this, "No Internet Connection", Toast.LENGTH_SHORT).show();
                }
            }
        });

        swipeRefreshLayout.setOnRefreshListener(new SwipeRefreshLayout.OnRefreshListener() {
            @Override
            public void onRefresh() {
                ParseQuery<ParseObject> query1 = ParseQuery.getQuery("Partner");
                query1.whereEqualTo("objectId", CochePartnerApplication.objectID);
                query1.getFirstInBackground(new GetCallback<ParseObject>() {
                    @Override
                    public void done(ParseObject object, ParseException e) {
                        if(e == null ){
                            CochePartnerApplication.Services = object.getString("Services");
                            process();
                        }else{
                            Toast.makeText(MainActivity.this, "No Internet Connection", Toast.LENGTH_SHORT).show();
                        }
                    }
                });
                swipeRefreshLayout.setRefreshing(false);
            }
        });

        ParseQuery<ParseObject> query = ParseQuery.getQuery("Partner");
        query.whereEqualTo("objectId", CochePartnerApplication.objectID);
        query.getFirstInBackground(new GetCallback<ParseObject>() {
            @Override
            public void done(ParseObject object, ParseException e) {
                if(e == null){
                    CochePartnerApplication.companyName = object.getString("CompanyName");
                    CochePartnerApplication.Services = object.getString("Services");

                }else{
                    Toast.makeText(MainActivity.this, "No internet connection", Toast.LENGTH_SHORT).show();
                }
            }
        });


    }

    public void intentapproved(View v) {
        Intent intent = new Intent();
        intent.setClass(MainActivity.this, ApprovedActivity.class);
        startActivity(intent);
        finish();
    }

    public void intentprofile(View v) {
        Intent intent = new Intent();
        intent.setClass(MainActivity.this, ProfileActivity.class);
        startActivity(intent);
        finish();
    }

    private void process() {
        ParseQuery<ParseObject> query = ParseQuery.getQuery("Reservation");
        query.whereEqualTo("ObjectID", CochePartnerApplication.objectID);
        //query.whereEqualTo("Services", CochePartnerApplication.Services);
        query.whereEqualTo("Status", "Pending");
        query.findInBackground(new FindCallback<ParseObject>() {
            @Override
            public void done(List<ParseObject> objects, ParseException e) {
                if(e == null){
//                    for (int j = 0; j < objects.size(); j++)
//                    {
//                        ParseObject parseObject = objects.get(j);
//                        //fetching data from parseObject
//                    }
                    //Toast.makeText(MainActivity.this, ""+objects.size(), Toast.LENGTH_SHORT).show();
                    bookingAdapter = new BookingAdapter(MainActivity.this, objects, rvBooking);
                    RecyclerView.LayoutManager mLayoutManager = new LinearLayoutManager(MainActivity.this, LinearLayoutManager.VERTICAL, false);
                    rvBooking.setLayoutManager(mLayoutManager);
                    rvBooking.setItemAnimator(new DefaultItemAnimator());
                    rvBooking.setAdapter(bookingAdapter);
                }else{
                    Toast.makeText(MainActivity.this, ""+e, Toast.LENGTH_SHORT).show();
                }
            }
        });
        CochePartnerApplication.firebaseDatabase = FirebaseDatabase.getInstance();
        CochePartnerApplication.sendstatus = CochePartnerApplication.firebaseDatabase.getReference("Carwash").child("1");
        CochePartnerApplication.sendstatus.addValueEventListener(new ValueEventListener() {
            @Override
            public void onDataChange(DataSnapshot dataSnapshot) {
                try {
                    if(dataSnapshot.child("Requestype").getValue().toString().compareToIgnoreCase("0")==0){

                        sendsms();

                    }
                }catch (Exception e){
                    Log.i("Error", " "+e);
                }

            }

            @Override
            public void onCancelled(DatabaseError databaseError) {
                Log.e("Database: ", ""+databaseError.getMessage());
                Toast.makeText(MainActivity.this, ""+databaseError.getMessage(), Toast.LENGTH_SHORT).show();
            }
        });
    }

    private void sendsms() {
        //J pagkuha sa data gkan sa database auto scheduling
        final ParseQuery<ParseObject> query = ParseQuery.getQuery("Reservation");
        query.whereEqualTo("ObjectID", CochePartnerApplication.objectID);
        //query.whereEqualTo("Services", CochePartnerApplication.Services);
        query.whereEqualTo("ServiceType", "Carwash");
        query.whereEqualTo("Status", "Approved");
        query.findInBackground(new FindCallback<ParseObject>() {
            @Override
            public void done(List<ParseObject> objects, ParseException e) {
                if(e == null){
                    for (int i = 0 ; i < objects.size(); i++){
                        ParseQuery<ParseObject> query2 = ParseQuery.getQuery("Users");
                        query2.whereEqualTo("FBID", objects.get(i).getString("FBID"));
                        query2.getFirstInBackground(new GetCallback<ParseObject>() {
                            @Override
                            public void done(ParseObject object, ParseException e) {
                                CochePartnerApplication.firebaseDatabase = FirebaseDatabase.getInstance();
                                CochePartnerApplication.sendstatus = CochePartnerApplication.firebaseDatabase.getReference("Carwash").child("1");
                                Status sendStatus = new Status("1");
                                CochePartnerApplication.sendstatus.setValue(sendStatus);
                                //Toast.makeText(MainActivity.this, ""+object.getString("Mobile"), Toast.LENGTH_SHORT).show();
                                String number = object.getString("Mobile");
                                String messageToSend = "There are new cancelation on our reservation. If you wish to move the schedule please click the link. http://usc.com/coche";
                                String phonenumber = number.substring(1);
                                number = "+63"+phonenumber;
                                SmsManager.getDefault().sendTextMessage(number, null, messageToSend, null,null);
                            }
                        });
                    }
                }else{
                    //Toast.makeText(MainActivity.this, ""+e, Toast.LENGTH_SHORT).show();
                }
            }
        });
    }
}
