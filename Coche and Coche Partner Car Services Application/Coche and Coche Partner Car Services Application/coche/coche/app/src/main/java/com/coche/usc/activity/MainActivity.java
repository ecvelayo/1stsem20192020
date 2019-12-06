package com.coche.usc.activity;

import android.Manifest;
import android.app.Activity;
import android.app.AlertDialog;
import android.app.ProgressDialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.pm.PackageManager;
import android.location.Location;

import android.os.Bundle;
import android.telephony.SmsManager;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.FrameLayout;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.TextView;
import android.widget.Toast;

import androidx.annotation.Nullable;
import androidx.core.app.ActivityCompat;
import androidx.core.content.ContextCompat;
import androidx.fragment.app.FragmentActivity;
import androidx.recyclerview.widget.DefaultItemAnimator;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import com.coche.usc.CocheApplication;
import com.coche.usc.Paypal.Config;
import com.coche.usc.activity.Model.SendStatus;
import com.coche.usc.activity.Model.User;
import com.google.android.gms.common.ConnectionResult;
import com.google.android.gms.common.api.GoogleApiClient;
import com.google.android.gms.location.LocationListener;
import com.google.android.gms.location.LocationRequest;
import com.google.android.gms.location.LocationServices;
import com.google.android.gms.maps.CameraUpdateFactory;
import com.google.android.gms.maps.GoogleMap;
import com.google.android.gms.maps.OnMapReadyCallback;
import com.google.android.gms.maps.SupportMapFragment;
import com.google.android.gms.maps.model.BitmapDescriptorFactory;
import com.google.android.gms.maps.model.CircleOptions;
import com.google.android.gms.maps.model.LatLng;
import com.google.android.gms.maps.model.Marker;
import com.google.android.gms.maps.model.MarkerOptions;
import com.google.android.material.floatingactionbutton.FloatingActionButton;
import com.google.firebase.FirebaseApp;
import com.google.firebase.database.DataSnapshot;
import com.google.firebase.database.DatabaseError;
import com.google.firebase.database.FirebaseDatabase;
import com.google.firebase.database.ValueEventListener;
import com.parse.FindCallback;
import com.parse.GetCallback;
import com.parse.Parse;
import com.parse.ParseException;
import com.parse.ParseGeoPoint;
import com.parse.ParseObject;
import com.parse.ParseQuery;

import java.math.BigDecimal;
import java.text.SimpleDateFormat;
import java.util.Calendar;
import java.util.Date;
import java.util.List;

import co.coche.usc.R;
import com.coche.usc.adapter.RepairAdapter;
import com.parse.SaveCallback;
import com.paypal.android.sdk.payments.PayPalConfiguration;
import com.paypal.android.sdk.payments.PayPalPayment;
import com.paypal.android.sdk.payments.PayPalService;
import com.paypal.android.sdk.payments.PaymentActivity;
import com.paypal.android.sdk.payments.PaymentConfirmation;

import org.json.JSONException;

public class MainActivity extends FragmentActivity implements OnMapReadyCallback,
        GoogleApiClient.ConnectionCallbacks,
        GoogleApiClient.OnConnectionFailedListener,
        LocationListener {

    private GoogleMap mMap;
    private LocationRequest locationRequest;
    private GoogleApiClient client;
    private Location lastlocation;
    private Marker currentLocationMarker, marker;
    private final int PERMISSION_REQUEST_ACCESS_FINE_LOCATION = 1;
    private boolean FIRST_LOCATION_RECEIVE = true;

    private RecyclerView rvRepair;
    private RepairAdapter repairAdapter;
    private ImageView imgCarwash, imgTow, imgProfile;
    private TextView tvCompanyName, tvCompanyAddress, tvDistance;
    private LinearLayout linRepair;
    private FloatingActionButton btnLocation;

    private static int UPDATE_INTERVAL = 5000;
    private static int FASTEST_INTERVAL = 3000;
    private static int DISTANCE = 10;
    private String object_id, number;
    private ProgressDialog pd;

    private Button btnPaynow;
    private  PayPalPayment payment;
    private double amount;
    private FrameLayout prevTransaction;
    private Button btnCancel;
    private ParseGeoPoint parseGeoPoint;
    private static final int PAYPAL_REQUEST_CODE = 7171;
    private static PayPalConfiguration config = new PayPalConfiguration()
            .environment(PayPalConfiguration.ENVIRONMENT_SANDBOX)

            .clientId(Config.PAYPAL_CLIENT_ID);

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        // Obtain the SupportMapFragment and get notified when the map is ready to be used.

        Parse.initialize(new Parse.Configuration.Builder(this)
                .applicationId(getString(R.string.back4app_app_id))
                // if defined
                .clientKey(getString(R.string.back4app_client_key))
                .server(getString(R.string.back4app_server_url))
                .build()
        );

        Intent intent = new Intent(this, PayPalService.class);

        intent.putExtra(PayPalService.EXTRA_PAYPAL_CONFIGURATION, config);

        startService(intent);


        FirebaseApp.initializeApp(this);


        pd = new ProgressDialog(MainActivity.this);
        pd.setMessage("Please wait...");
        pd.show();

        setupviews();
        buttonprocess();
    }

    private void setupviews() {
        SupportMapFragment mapFragment = (SupportMapFragment) getSupportFragmentManager()
                .findFragmentById(R.id.map);
        mapFragment.getMapAsync(this);

        rvRepair = findViewById(R.id.rv_repair);
        imgCarwash = findViewById(R.id.img_carwash);
        imgTow = findViewById(R.id.img_tow);
        imgProfile = findViewById(R.id.img_profile);
        tvCompanyName = findViewById(R.id.company_name);
        tvCompanyAddress = findViewById(R.id.company_address);
        tvDistance = findViewById(R.id.distance);
        btnCancel = findViewById(R.id.btn_cancel);
        prevTransaction = findViewById(R.id.frame_transaction);
        linRepair = findViewById(R.id.lin_repair);
        btnLocation = findViewById(R.id.floating_location);
        btnPaynow = findViewById(R.id.btn_paynow);

        linRepair.setBackgroundColor(getResources().getColor(R.color.orange));

    }

    private void buttonprocess() {

        btnCancel.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                AlertDialog.Builder builder = new AlertDialog.Builder(MainActivity.this);

                builder.setTitle("Confirmation");
                builder.setMessage("Are you sure you want to cancel this reservation?");

                builder.setPositiveButton("YES", new DialogInterface.OnClickListener() {

                    public void onClick(DialogInterface dialog, int which) {
                        //deletefb();

                        Date c = Calendar.getInstance().getTime();
                        System.out.println("Current time => " + c);

                        SimpleDateFormat df = new SimpleDateFormat("dd-MMM-yyyy hh:mm aaa");
                        final String updatedAt = df.format(c);

                        ParseQuery<ParseObject> query1 = ParseQuery.getQuery("Reservation");
                        query1.whereEqualTo("objectId", object_id);
                        query1.getFirstInBackground(new GetCallback<ParseObject>() {
                            @Override
                            public void done(final ParseObject object, ParseException e) {
                                if(e == null){
                                    if(object.getString("PaymentStatus").compareToIgnoreCase("Paid")==0){
                                        Toast.makeText(MainActivity.this, "Successfully Cancelled. We have fully refunded your payment. Please be reminded that your next transaction we will add P50.00 for your penalty", Toast.LENGTH_LONG).show();
                                    }else if(object.getString("PaymentStatus").compareToIgnoreCase("NotPaid")==0 && object.getString("Status").compareToIgnoreCase("Approved")==0){
                                        Toast.makeText(MainActivity.this, "Successfully Cancelled. Please be reminded that your next transaction we will add P50.00 for your penalty.", Toast.LENGTH_LONG).show();
                                    }else{
                                        Toast.makeText(MainActivity.this, "Successfully canceled", Toast.LENGTH_SHORT).show();
                                    }
                                    if(object.getString("Status").compareToIgnoreCase("Approved")==0){

                                        ParseQuery<ParseObject> query2 = ParseQuery.getQuery("Users");
                                        query2.whereEqualTo("FBID", object.getString("FBID"));
                                        query2.getFirstInBackground(new GetCallback<ParseObject>() {
                                            @Override
                                            public void done(ParseObject object1, ParseException e) {
                                                if(e == null){
                                                    object1.put("PenaltyStatus", "1");
                                                    object1.saveInBackground();
                                                }
                                            }
                                        });
                                    }
                                    object.put("Status", "Canceled");
                                    object.put("updated_at", updatedAt);
                                    object.saveInBackground(new SaveCallback() {
                                        @Override
                                        public void done(ParseException e) {
                                            if(e == null){
                                                deletefb(object.getString("ObjectID"));
                                                String messageToSend = "Sorry, I have cancelled my reservation due to personal reason";
                                                String phonenumber = number.substring(1);
                                                number = "+63"+phonenumber;
                                                SmsManager.getDefault().sendTextMessage(number, null, messageToSend, null,null);
                                                Intent intent = new Intent();
                                                intent.setClass(MainActivity.this, MainActivity.class);
                                                startActivity(intent);
                                                finish();
                                            }else{
                                                Toast.makeText(MainActivity.this, "Please check your internet connection", Toast.LENGTH_SHORT).show();
                                            }
                                        }
                                    });

                                }else{
                                    Toast.makeText(MainActivity.this, "Please check your internet connection.", Toast.LENGTH_SHORT).show();
                                }
                            }
                        });

                        dialog.dismiss();
                    }
                });

                builder.setNegativeButton("NO", new DialogInterface.OnClickListener() {

                    @Override
                    public void onClick(DialogInterface dialog, int which) {

                        // Do nothing
                        dialog.dismiss();
                    }
                });

                AlertDialog alert = builder.create();
                alert.show();
            }
        });

        btnPaynow.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                ParseQuery<ParseObject> query1 = ParseQuery.getQuery("Reservation");
                query1.whereEqualTo("objectId", object_id);
                query1.getFirstInBackground(new GetCallback<ParseObject>() {
                    @Override
                    public void done(ParseObject object1, ParseException e) {
                        if(e == null){

                            //Toast.makeText(CarwashActivity.this, ""+object.getString("CarCategory"), Toast.LENGTH_SHORT).show();
                            ParseQuery<ParseObject> query2 = ParseQuery.getQuery("Users");
                            query2.whereEqualTo("FBID", object1.getString("FBID"));
                            query2.getFirstInBackground(new GetCallback<ParseObject>() {
                                @Override
                                public void done(ParseObject object, ParseException e) {
                                    if(e == null){
                                        lunchpayment(object.getString("PenaltyStatus"));
                                    }
                                }
                            });

                        }else{
                            Toast.makeText(MainActivity.this, ""+object_id, Toast.LENGTH_SHORT).show();
                        }
                    }
                });

            }
        });

    }

    private void lunchpayment(String penaltyStatus) {
        if(penaltyStatus.compareToIgnoreCase("1")==0){
         payment   = new PayPalPayment(new BigDecimal("150.00"), "PHP", "Coche. Repair Consultation",
                    PayPalPayment.PAYMENT_INTENT_SALE);
         amount = 150.00;
        }else{
            payment   = new PayPalPayment(new BigDecimal("100.00"), "PHP", "Coche. Repair Consultation",
                    PayPalPayment.PAYMENT_INTENT_SALE);
            amount = 100.00;
        }


        Intent intent = new Intent(this, PaymentActivity.class);

        // send the same configuration for restart resiliency
        intent.putExtra(PayPalService.EXTRA_PAYPAL_CONFIGURATION, config);

        intent.putExtra(PaymentActivity.EXTRA_PAYMENT, payment);

        startActivityForResult(intent, PAYPAL_REQUEST_CODE);
    }

    @Override
    protected void onDestroy() {
        stopService(new Intent(this, PayPalService.class));
        super.onDestroy();
    }

    @Override
    protected void onActivityResult(int requestCode, int resultCode, @Nullable Intent data) {
        if (requestCode == PAYPAL_REQUEST_CODE) {
            if (resultCode == Activity.RESULT_OK) {
                PaymentConfirmation confirm = data.getParcelableExtra(PaymentActivity.EXTRA_RESULT_CONFIRMATION);
                if (confirm != null) {
                    try {
                        Log.i("paymentExample", confirm.toJSONObject().toString(4));

                        ParseQuery<ParseObject> query1 = ParseQuery.getQuery("Reservation");
                        query1.whereEqualTo("objectId", object_id);
                        query1.whereEqualTo("Status", "Approved");
                        query1.getFirstInBackground(new GetCallback<ParseObject>() {
                            @Override
                            public void done(final ParseObject object, ParseException e) {
                                if(e == null){

                                    Date c = Calendar.getInstance().getTime();
                                    System.out.println("Current time => " + c);

                                    SimpleDateFormat df = new SimpleDateFormat("dd-MMM-yyyy hh:mm aaa");
                                    final String updatedAt = df.format(c);
                                    object.put("Amount", ""+amount);
                                    object.put("PaymentStatus", "Paid");
                                    object.put("updated_at", updatedAt);
                                    object.saveInBackground(new SaveCallback() {
                                        @Override
                                        public void done(ParseException e) {
                                            if(e == null){
                                                Toast.makeText(MainActivity.this, "Payment Successful.", Toast.LENGTH_SHORT).show();
                                                Intent intent = new Intent();
                                                intent.setClass(MainActivity.this, MainActivity.class);
                                                startActivity(intent);
                                                finish();
                                            }else{
                                                Toast.makeText(MainActivity.this, "Please check your internet connection", Toast.LENGTH_SHORT).show();
                                            }
                                        }
                                    });
                                }else{
                                    Toast.makeText(MainActivity.this, "Please check your internet connection.", Toast.LENGTH_SHORT).show();
                                }
                            }
                        });

                        // TODO: send 'confirm' to your server for verification.
                        // see https://developer.paypal.com/webapps/developer/docs/integration/mobile/verify-mobile-payment/
                        // for more details.

                    } catch (JSONException e) {
                        Log.e("paymentExample", "an extremely unlikely failure occurred: ", e);
                    }
                }
            }
            else if (resultCode == Activity.RESULT_CANCELED) {
                Log.i("paymentExample", "The user canceled.");
                Toast.makeText(this, "Payment canceled.", Toast.LENGTH_SHORT).show();
            }
            else if (resultCode == PaymentActivity.RESULT_EXTRAS_INVALID) {
                Log.i("paymentExample", "An invalid Payment or PayPalConfiguration was submitted. Please see the docs.");
            }
        }
    }

    private void deletefb(final String objectID) {
        CocheApplication.firebaseDatabase = FirebaseDatabase.getInstance();
        CocheApplication.sendstatus = CocheApplication.firebaseDatabase.getReference("Reservation").child(objectID);
        CocheApplication.sendstatus.addValueEventListener(new ValueEventListener() {
            @Override
            public void onDataChange(DataSnapshot dataSnapshot) {
                for (DataSnapshot childkey : dataSnapshot.getChildren()) {
                    String key = childkey.getKey();
                    //Toast.makeText(MainActivity.this, ""+childkey.child("FBUSER").getValue()+" "+key, Toast.LENGTH_SHORT).show();
                    if(childkey.child("FBUSER").getValue().toString().compareTo(CocheApplication.FBID)==0){
                        childkey.getRef().removeValue();
                    }
                }

            }
            @Override
            public void onCancelled(DatabaseError databaseError) {
                Log.e("Database: ", ""+databaseError.getMessage());
                Toast.makeText(MainActivity.this, ""+databaseError.getMessage(), Toast.LENGTH_SHORT).show();
            }
        });
    }

    public void intentlocation(View v){
        lastlocation = LocationServices.FusedLocationApi.getLastLocation(client);
        try {
            final LatLng latLng = new LatLng(lastlocation.getLatitude(), lastlocation.getLongitude());
            if (currentLocationMarker != null) {
                currentLocationMarker.remove();
            }

            currentLocationMarker = mMap.addMarker(new MarkerOptions()
                    .icon(BitmapDescriptorFactory.fromResource(R.drawable.marker))
                    .position(latLng).title("Your current location"));

            parseGeoPoint = new ParseGeoPoint(lastlocation.getLatitude(), lastlocation.getLongitude());


            mMap.animateCamera(CameraUpdateFactory.newLatLngZoom(latLng, 15));
            FIRST_LOCATION_RECEIVE = false;
        }catch (Exception e){
            Log.i("Error:", ""+e);
        }
    }

    public void intentcarwash(View v){
        Intent intent = new Intent(MainActivity.this, CarwashActivity.class);
        intent.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK | Intent.FLAG_ACTIVITY_CLEAR_TASK);
        startActivity(intent);
        finish();
        overridePendingTransition(R.anim.slide_in_right, R.anim.slide_out_left);
    }

    public void intenttow(View v){
        Intent intent = new Intent(MainActivity.this, TowActivity.class);
        intent.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK | Intent.FLAG_ACTIVITY_CLEAR_TASK);
        startActivity(intent);
        finish();
        overridePendingTransition(R.anim.slide_in_right, R.anim.slide_out_left);
    }

    public void intentprofile(View v){
        Intent intent = new Intent(MainActivity.this, ProfileActivity.class);
        intent.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK | Intent.FLAG_ACTIVITY_CLEAR_TASK);
        startActivity(intent);
        finish();
        overridePendingTransition(R.anim.slide_in_right, R.anim.slide_out_left);
    }


    @Override
    public void onMapReady(GoogleMap googleMap) {
        mMap = googleMap;

        mMap.setOnMyLocationClickListener(onMyLocationClickListener);
//        if (Build.VERSION.SDK_INT < 23) {
//            searchBookingRequestService();
//            return;
//        }

        if (ContextCompat.checkSelfPermission(this, Manifest.permission.ACCESS_FINE_LOCATION) == PackageManager.PERMISSION_GRANTED) {
            mMap.setMyLocationEnabled(false);
        }
    }


    @Override
    protected void onResume() {
        super.onResume();

        if (ContextCompat.checkSelfPermission(this, Manifest.permission.ACCESS_FINE_LOCATION) == PackageManager.PERMISSION_GRANTED) {
            buildGoogleApiClient();
        } else {
            if (ActivityCompat.shouldShowRequestPermissionRationale(this, android.Manifest.permission.ACCESS_FINE_LOCATION)) {
                showRationaleDialog();
            } else {
                ActivityCompat.requestPermissions(this, new String[]{android.Manifest.permission.ACCESS_FINE_LOCATION}, PERMISSION_REQUEST_ACCESS_FINE_LOCATION);
            }
        }
    }

    private void buildGoogleApiClient() {
        client = new GoogleApiClient.Builder(this)
                .addConnectionCallbacks(this)
                .addOnConnectionFailedListener(this)
                .addApi(LocationServices.API)
                .build();
        client.connect();
    }

    private void showRationaleDialog() {
        new AlertDialog.Builder(this)
                .setPositiveButton("Accept", new DialogInterface.OnClickListener() {
                    @Override
                    public void onClick(DialogInterface dialog, int which) {
                        dialog.dismiss();
                        ActivityCompat.requestPermissions(MainActivity.this,
                                new String[]{Manifest.permission.ACCESS_FINE_LOCATION}, PERMISSION_REQUEST_ACCESS_FINE_LOCATION);
                    }
                })
                .setNegativeButton("Cancel", new DialogInterface.OnClickListener() {
                    @Override
                    public void onClick(DialogInterface dialog, int which) {
                        Toast.makeText(MainActivity.this, "gps denied", Toast.LENGTH_SHORT).show();
                        ;
                        dialog.dismiss();
                    }
                })
                .setCancelable(false)
                .setTitle("Location permission needed")
                .setMessage(getResources().getString(R.string.location_permission_needed_message))
                .show();
    }

    private GoogleMap.OnMyLocationClickListener onMyLocationClickListener =
            new GoogleMap.OnMyLocationClickListener() {
                @Override
                public void onMyLocationClick( Location location) {

                    //mMap.setMinZoomPreference(15);

                    CircleOptions circleOptions = new CircleOptions();
                    circleOptions.center(new LatLng(location.getLatitude(),
                            location.getLongitude()));

                    circleOptions.radius(200);
                    circleOptions.fillColor(ContextCompat.getColor(getApplicationContext(), R.color.colorTransparentBlue));
                    circleOptions.strokeColor(ContextCompat.getColor(getApplicationContext(), R.color.colorBlue));
                    circleOptions.strokeWidth(2);

                    mMap.addCircle(circleOptions);

                }
            };

    @Override
    public void onRequestPermissionsResult(int requestCode, String[] permissions, int[] grantResults) {
        switch (requestCode) {
            case PERMISSION_REQUEST_ACCESS_FINE_LOCATION: {
                if (grantResults.length > 0 && grantResults[0] == PackageManager.PERMISSION_GRANTED) {

                    //searchBookingRequestService();
                    try {
                        if (ContextCompat.checkSelfPermission(this, Manifest.permission.ACCESS_FINE_LOCATION) == PackageManager.PERMISSION_GRANTED) {
                            mMap.setMyLocationEnabled(false);
                        }
                    } catch (Exception e) {
                        Log.e("Error", "" + e);
                    }
                } else {
                    showRationaleDialog();
                }
                break;
            }
        }
    }

    @Override
    public void onConnected( Bundle bundle) {
        locationRequest = new LocationRequest();
        locationRequest.setInterval(UPDATE_INTERVAL);
        locationRequest.setFastestInterval(FASTEST_INTERVAL);
        locationRequest.setSmallestDisplacement(DISTANCE);
        locationRequest.setPriority(LocationRequest.PRIORITY_HIGH_ACCURACY);
        if (ActivityCompat.checkSelfPermission(this, Manifest.permission.ACCESS_FINE_LOCATION)
                != PackageManager.PERMISSION_GRANTED &&
                ActivityCompat.checkSelfPermission(this, Manifest.permission.ACCESS_COARSE_LOCATION)
                        != PackageManager.PERMISSION_GRANTED) {

            return;
        }
        if (client.isConnected()) {
            LocationServices.FusedLocationApi.requestLocationUpdates(client, locationRequest, this);
        } else {
            client.connect();
        }
        displayLocation();
    }

    private void displayLocation() {
        if (ActivityCompat.checkSelfPermission(this, Manifest.permission.ACCESS_FINE_LOCATION) != PackageManager.PERMISSION_GRANTED && ActivityCompat.checkSelfPermission(this, Manifest.permission.ACCESS_COARSE_LOCATION) != PackageManager.PERMISSION_GRANTED) {
            return;
        }
        lastlocation = LocationServices.FusedLocationApi.getLastLocation(client);
        try {
            final LatLng latLng = new LatLng(lastlocation.getLatitude(), lastlocation.getLongitude());
            if (currentLocationMarker != null) {
                currentLocationMarker.remove();
            }

            currentLocationMarker = mMap.addMarker(new MarkerOptions()
                    .icon(BitmapDescriptorFactory.fromResource(R.drawable.marker))
                    .position(latLng).title("Your current location"));

            parseGeoPoint = new ParseGeoPoint(lastlocation.getLatitude(), lastlocation.getLongitude());

            if (FIRST_LOCATION_RECEIVE) {

                mMap.animateCamera(CameraUpdateFactory.newLatLngZoom(latLng, 15));
                FIRST_LOCATION_RECEIVE = false;
            }

        }catch (Exception e){
            Log.i("Error:", ""+e);
        }
        process();
    }

    private void process() {
        final ParseQuery<ParseObject> query1 = ParseQuery.getQuery("Reservation");
        query1.whereEqualTo("FBID", CocheApplication.FBID);
        query1.whereEqualTo("ServiceType", "Repair");
//        query1.whereNotEqualTo("Status", "Canceled");
//        query1
        //query1.whereNotEqualTo("Status", "Completed");
        query1.findInBackground(new FindCallback<ParseObject>() {
            @Override
            public void done(final List<ParseObject> objects, ParseException e) {
                if(e == null){
                    if(objects.size()>0){
                        for(int i=0; i<objects.size() ; i++){
                            //Toast.makeText(CarwashActivity.this, ""+objects.get(i).get("Status").toString(), Toast.LENGTH_SHORT).show();
                            if(objects.get(i).get("Status").toString().compareTo("Pending") ==0 || objects.get(i).get("Status").toString().compareTo("Approved") ==0 || objects.get(i).get("Status").toString().compareToIgnoreCase("Paid")==0){
                                if(objects.get(i).get("PaymentStatus").toString().compareToIgnoreCase("NotPaid")==0 && objects.get(i).get("Status").toString().compareToIgnoreCase("Approved")==0){
                                    btnPaynow.setVisibility(View.VISIBLE);
                                }
                                ParseQuery<ParseObject> query2 = ParseQuery.getQuery("Partner");
                                query2.whereEqualTo("objectId", objects.get(i).getString("ObjectID"));
                                query2.whereEqualTo("Services", "Repair");
                                final int finalI = i;
                                query2.getFirstInBackground(new GetCallback<ParseObject>() {
                                    @Override
                                    public void done(ParseObject object, ParseException e) {
                                        if(e == null){
                                            pd.dismiss();
                                            prevTransaction.setVisibility(View.VISIBLE);
                                            rvRepair.setVisibility(View.GONE);
                                            object_id = objects.get(finalI).getObjectId();
                                            tvCompanyAddress.setText(object.getString("Address"));
                                            tvCompanyName.setText(object.getString("CompanyName"));
                                            Location location1 = new Location("Locationa1");
                                            number = object.getString("Number");
                                            location1.setLatitude(lastlocation.getLatitude());
                                            location1.setLongitude(lastlocation.getLongitude());
                                            Location location2 = new Location("Location2");
                                            location2.setLatitude(object.getParseGeoPoint("Location").getLatitude());
                                            location2.setLongitude(object.getParseGeoPoint("Location").getLongitude());
                                            double distanceInMeters = location1.distanceTo(location2) / 1000;
                                            tvDistance.setText(String.format("%.2f",distanceInMeters)+" Kilometers");
                                        }
                                    }
                                });
                            }else{

                            }
                        }
                    }
                }else{
                    Toast.makeText(MainActivity.this, "No Internet Connection", Toast.LENGTH_SHORT).show();
                }
            }
        });

//        Date c = Calendar.getInstance().getTime();
//        System.out.println("Current time => " + c);
//
//        SimpleDateFormat df = new SimpleDateFormat("MM dd yyyy");
//        String date = df.format(c);
//
//        ParseQuery<ParseObject> query1 = ParseQuery.getQuery("Reservation");
//        query1.whereEqualTo("FBID", CocheApplication.FBID);
//        //query1.whereEqualTo("Date", date);
//        query1.whereNotEqualTo("Status", "Canceled");
//        query1.getFirstInBackground(new GetCallback<ParseObject>() {
//            @Override
//            public void done(final ParseObject object1, ParseException e) {
//                if(e == null){
//                    if(object1.getString("PaymentStatus").compareToIgnoreCase("NotPaid")==0){
//                        btnPaynow.setVisibility(View.VISIBLE);
//                    }if(object1.getString("Status").compareToIgnoreCase("Completed")==0){
                        ParseQuery<ParseObject> query = ParseQuery.getQuery("Partner");
                        query.whereEqualTo("Services", "Repair");
                        query.findInBackground(new FindCallback<ParseObject>() {
                            @Override
                            public void done(List<ParseObject> objects, ParseException e) {
                                if(e == null){
//                    for (int j = 0; j < objects.size(); j++)
//                    {
//                        ParseObject parseObject = objects.get(j);
//                        //fetching data from parseObject
//                    }
                                    // Toast.makeText(MainActivity.this, ""+objects.size(), Toast.LENGTH_SHORT).show();
                                    pd.dismiss();
                                    repairAdapter = new RepairAdapter(MainActivity.this, objects, mMap, marker, lastlocation.getLatitude(), lastlocation.getLongitude(), currentLocationMarker);
                                    RecyclerView.LayoutManager mLayoutManager = new LinearLayoutManager(MainActivity.this, LinearLayoutManager.HORIZONTAL, false);
                                    rvRepair.setLayoutManager(mLayoutManager);
                                    rvRepair.setItemAnimator(new DefaultItemAnimator());
                                    rvRepair.setAdapter(repairAdapter);
                                }else{
                                    pd.dismiss();
                                    Toast.makeText(MainActivity.this, ""+e, Toast.LENGTH_SHORT).show();
                                }
                            }
                        });
//
//                    }else{
//                        ParseQuery<ParseObject> query2 = ParseQuery.getQuery("Partner");
//                        query2.whereEqualTo("objectId", object1.getString("ObjectID"));
//                        query2.whereEqualTo("Services", "Repair");
//                        query2.getFirstInBackground(new GetCallback<ParseObject>() {
//                            @Override
//                            public void done(ParseObject object, ParseException e) {
//                                if(e == null){
//                                    pd.dismiss();
//                                    prevTransaction.setVisibility(View.VISIBLE);
//                                    rvRepair.setVisibility(View.GONE);
//                                    object_id = object1.getObjectId();
//                                    tvCompanyAddress.setText(object.getString("Address"));
//                                    tvCompanyName.setText(object.getString("CompanyName"));
//                                    Location location1 = new Location("Locationa1");
//                                    number = object.getString("Number");
//                                    location1.setLatitude(lastlocation.getLatitude());
//                                    location1.setLongitude(lastlocation.getLongitude());
//                                    Location location2 = new Location("Location2");
//                                    location2.setLatitude(object.getParseGeoPoint("Location").getLatitude());
//                                    location2.setLongitude(object.getParseGeoPoint("Location").getLongitude());
//                                    double distanceInMeters = location1.distanceTo(location2) / 1000;
//                                    tvDistance.setText(String.format("%.2f",distanceInMeters)+" Kilometers");
//                                }else{
//                                    ParseQuery<ParseObject> query = ParseQuery.getQuery("Partner");
//                                    query.whereEqualTo("Services", "Repair");
//                                    query.findInBackground(new FindCallback<ParseObject>() {
//                                        @Override
//                                        public void done(List<ParseObject> objects, ParseException e) {
//                                            if(e == null){
////                    for (int j = 0; j < objects.size(); j++)
////                    {
////                        ParseObject parseObject = objects.get(j);
////                        //fetching data from parseObject
////                    }
//                                                // Toast.makeText(MainActivity.this, ""+objects.size(), Toast.LENGTH_SHORT).show();
//                                                pd.dismiss();
//                                                repairAdapter = new RepairAdapter(MainActivity.this, objects, mMap, marker, lastlocation.getLatitude(), lastlocation.getLongitude(), currentLocationMarker);
//                                                RecyclerView.LayoutManager mLayoutManager = new LinearLayoutManager(MainActivity.this, LinearLayoutManager.HORIZONTAL, false);
//                                                rvRepair.setLayoutManager(mLayoutManager);
//                                                rvRepair.setItemAnimator(new DefaultItemAnimator());
//                                                rvRepair.setAdapter(repairAdapter);
//                                            }else{
//                                                pd.dismiss();
//                                                Toast.makeText(MainActivity.this, ""+e, Toast.LENGTH_SHORT).show();
//                                            }
//                                        }
//                                    });
//                                }
//                            }
//                        });
//                    }
//
//
//                }else{
//
//                    ParseQuery<ParseObject> query = ParseQuery.getQuery("Partner");
//                    query.whereEqualTo("Services", "Repair");
//                    query.whereEqualTo("Status", 1);
//                    query.whereNear("Location", parseGeoPoint);
//                    query.findInBackground(new FindCallback<ParseObject>() {
//                        @Override
//                        public void done(List<ParseObject> objects, ParseException e) {
//                            if(e == null){
////                    for (int j = 0; j < objects.size(); j++)
////                    {
////                        ParseObject parseObject = objects.get(j);
////                        //fetching data from parseObject
////                    }
//                                // Toast.makeText(MainActivity.this, ""+objects.size(), Toast.LENGTH_SHORT).show();
//                                pd.dismiss();
//                                repairAdapter = new RepairAdapter(MainActivity.this, objects, mMap, marker, lastlocation.getLatitude(), lastlocation.getLongitude(), currentLocationMarker);
//                                RecyclerView.LayoutManager mLayoutManager = new LinearLayoutManager(MainActivity.this, LinearLayoutManager.HORIZONTAL, false);
//                                rvRepair.setLayoutManager(mLayoutManager);
//                                rvRepair.setItemAnimator(new DefaultItemAnimator());
//                                rvRepair.setAdapter(repairAdapter);
//                            }else{
//                                pd.dismiss();
//                                Toast.makeText(MainActivity.this, ""+e, Toast.LENGTH_SHORT).show();
//                            }
//                        }
//                    });
//                }
//            }
//        });
    }

    @Override
    public void onConnectionSuspended(int i) {
        client.connect();
    }

    @Override
    public void onConnectionFailed( ConnectionResult connectionResult) {

    }

    @Override
    public void onLocationChanged(Location location) {
        lastlocation = location;
        displayLocation();
    }
}
