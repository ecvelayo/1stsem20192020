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
import android.view.LayoutInflater;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.FrameLayout;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.TextView;
import android.widget.Toast;

import androidx.annotation.Nullable;
import androidx.annotation.VisibleForTesting;
import androidx.core.app.ActivityCompat;
import androidx.core.content.ContextCompat;
import androidx.fragment.app.FragmentActivity;
import androidx.recyclerview.widget.DefaultItemAnimator;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import com.coche.usc.CocheApplication;
import com.coche.usc.Paypal.Config;
import com.coche.usc.activity.Model.SendStatus;
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
import com.google.firebase.database.DataSnapshot;
import com.google.firebase.database.DatabaseError;
import com.google.firebase.database.FirebaseDatabase;
import com.google.firebase.database.ValueEventListener;
import com.parse.DeleteCallback;
import com.parse.FindCallback;
import com.parse.GetCallback;
import com.parse.ParseException;
import com.parse.ParseGeoPoint;
import com.parse.ParseObject;
import com.parse.ParseQuery;

import java.math.BigDecimal;
import java.text.SimpleDateFormat;
import java.time.DayOfWeek;
import java.time.LocalDate;
import java.util.ArrayList;
import java.util.Calendar;
import java.util.Date;
import java.util.GregorianCalendar;
import java.util.List;
import java.util.Locale;

import co.coche.usc.R;
import com.coche.usc.adapter.CarwashAdapter;
import com.parse.SaveCallback;
import com.paypal.android.sdk.payments.PayPalConfiguration;
import com.paypal.android.sdk.payments.PayPalPayment;
import com.paypal.android.sdk.payments.PayPalService;
import com.paypal.android.sdk.payments.PaymentActivity;
import com.paypal.android.sdk.payments.PaymentConfirmation;
import com.tsongkha.spinnerdatepicker.SpinnerDatePickerDialogBuilder;

import org.json.JSONException;

public class CarwashActivity extends FragmentActivity implements OnMapReadyCallback,
        GoogleApiClient.ConnectionCallbacks,
        GoogleApiClient.OnConnectionFailedListener,
        LocationListener,
        com.tsongkha.spinnerdatepicker.DatePickerDialog.OnDateSetListener{

    private GoogleMap mMap;
    private LocationRequest locationRequest;
    private GoogleApiClient client;
    private Location lastlocation;
    private Marker currentLocationMarker, marker;
    private final int PERMISSION_REQUEST_ACCESS_FINE_LOCATION = 1;
    private boolean FIRST_LOCATION_RECEIVE = true;

    private RecyclerView rvCarwash;
    private CarwashAdapter carwashAdapter;

    private String object_id, number;

    private ImageView btnRepair, btnTow, btnProfile;
    private EditText datepicker;

    private static int UPDATE_INTERVAL = 5000;
    private static int FASTEST_INTERVAL = 3000;
    private static int DISTANCE = 10;

    private String dayName;

    private ProgressDialog pd;

    private SimpleDateFormat simpleDateFormat;

    private ArrayList<String> closedDay = new ArrayList<>();

    private int year, month, day,  dayofthemonth;
    private FrameLayout prevTransaction;
    private LinearLayout linCarwash;
    private TextView tvCompanyName, tvCompanyAddress, tvDistance;
    private Button btnCancel, btnPaynow;
    private ParseGeoPoint parseGeoPoint;

    private static final int PAYPAL_REQUEST_CODE = 7171;
    private static PayPalConfiguration config = new PayPalConfiguration()
            .environment(PayPalConfiguration.ENVIRONMENT_SANDBOX)

            .clientId(Config.PAYPAL_CLIENT_ID);

    String objectID;
    private PayPalPayment payment;
    private double amount;
    private Calendar calendar;

    DayOfWeek dow;
    LocalDate date;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_carwash);

        Intent intent = new Intent(this, PayPalService.class);

        intent.putExtra(PayPalService.EXTRA_PAYPAL_CONFIGURATION, config);

        startService(intent);

        setupviews();
    }

    private void setupviews() {
        SupportMapFragment mapFragment = (SupportMapFragment) getSupportFragmentManager()
                .findFragmentById(R.id.map);
        mapFragment.getMapAsync(this);

        pd = new ProgressDialog(CarwashActivity.this);
        pd.setMessage("Please wait, Gathering Data....");
        pd.show();

        rvCarwash = findViewById(R.id.rv_carwash);
        btnRepair = findViewById(R.id.btn_repair);
        btnTow = findViewById(R.id.btn_tow);
        btnProfile = findViewById(R.id.btn_profile);
        datepicker = findViewById(R.id.edit_date);
        prevTransaction = findViewById(R.id.frame_transaction);
        tvCompanyAddress = findViewById(R.id.company_name);
        tvCompanyName = findViewById(R.id.company_address);
        tvDistance = findViewById(R.id.distance);
        btnCancel = findViewById(R.id.btn_cancel);
        linCarwash = findViewById(R.id.lin_carwash);
        btnPaynow = findViewById(R.id.btn_paynow);

        linCarwash.setBackgroundColor(getResources().getColor(R.color.orange));

        simpleDateFormat = new SimpleDateFormat("yyyy-MM-dd", Locale.US);
        Calendar calendar = Calendar.getInstance();
        year = calendar.get(Calendar.YEAR);
        day = calendar.get(Calendar.DAY_OF_WEEK)-1;
        month = calendar.get(Calendar.MONTH);
        dayofthemonth = calendar.get(Calendar.DAY_OF_MONTH);

        datepicker.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                showDate(year, month, dayofthemonth, R.style.DatePickerSpinner);
            }
        });

        datepicker.setOnFocusChangeListener(new View.OnFocusChangeListener() {
            @Override
            public void onFocusChange(View view, boolean hasFocus) {
                if (hasFocus) {
                    datepicker.callOnClick();
                }
            }
        });

        btnCancel.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                AlertDialog.Builder builder = new AlertDialog.Builder(CarwashActivity.this);

                builder.setTitle("Confirmation");
                builder.setMessage("Are you sure you want to cancel this reservation?");

                builder.setPositiveButton("YES", new DialogInterface.OnClickListener() {

                    public void onClick(DialogInterface dialog, int which) {


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
                                        Toast.makeText(CarwashActivity.this, "Successfully Cancelled. We have fully refunded your payment. Please be reminded that your next transaction we will add P50.00 for your penalty", Toast.LENGTH_LONG).show();
                                    }else if(object.getString("PaymentStatus").compareToIgnoreCase("NotPaid")==0 && object.getString("Status").compareToIgnoreCase("Approved")==0){
                                        Toast.makeText(CarwashActivity.this, "Successfully Cancelled. Please be reminded that your next transaction we will add P50.00 for your penalty.", Toast.LENGTH_LONG).show();
                                    }else{
                                        Toast.makeText(CarwashActivity.this, "Successfully canceled", Toast.LENGTH_SHORT).show();
                                    }
                                    if(object.getString("Status").compareToIgnoreCase("Aprroved")==0){
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
                                                CocheApplication.firebaseDatabase = FirebaseDatabase.getInstance();
                                                CocheApplication.sendstatus = CocheApplication.firebaseDatabase.getReference("Carwash").child("1");
                                                SendStatus sendStatus = new SendStatus("0");
                                                CocheApplication.sendstatus.setValue(sendStatus);
                                                String messageToSend = "Sorry, I have cancelled my reservation due to personal reason";
                                                String phonenumber = number.substring(1);
                                                number = "+63"+phonenumber;
                                                SmsManager.getDefault().sendTextMessage(number, null, messageToSend, null,null);
                                                //Toast.makeText(CarwashActivity.this, ""+number, Toast.LENGTH_SHORT).show();
                                                Intent intent = new Intent();
                                                intent.setClass(CarwashActivity.this, MainActivity.class);
                                                startActivity(intent);
                                                finish();
                                            }else{
                                                Toast.makeText(CarwashActivity.this, "Please check you internet connection", Toast.LENGTH_SHORT).show();
                                            }
                                        }
                                    });

                                }else{
                                    Toast.makeText(CarwashActivity.this, ""+object_id, Toast.LENGTH_SHORT).show();
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
                lunchpayment();
            }
        });

        if(day == 1){
            dayName = "Monday";
        }else if(day == 2){
            dayName = "Tuesday";
        }else if (day == 3){
            dayName = "Wednesday";
        }else if (day == 4){
            dayName = "Thursday";
        }else if (day == 5){
            dayName = "Friday";
        }else if (day == 6){
            dayName = "Saturday";
        }else if (day == 7){
            dayName = "Sunday";
        }


    }

    private void deletefb(String objectID) {
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
                Toast.makeText(CarwashActivity.this, ""+databaseError.getMessage(), Toast.LENGTH_SHORT).show();
            }
        });
    }

    private void lunchpayment() {
        ParseQuery<ParseObject> query1 = ParseQuery.getQuery("Reservation");
        query1.whereEqualTo("objectId", object_id);
        query1.getFirstInBackground(new GetCallback<ParseObject>() {
            @Override
            public void done(final ParseObject object1, ParseException e) {
                if(e == null){
                    ParseQuery<ParseObject> query1 = ParseQuery.getQuery("Car");
                    query1.whereEqualTo("CarPlateNumber", object1.getString("CarPlateNumber"));
                    query1.getFirstInBackground(new GetCallback<ParseObject>() {
                        @Override
                        public void done(ParseObject object, ParseException e) {
                            if(e == null){
                                CocheApplication.carCategory = object.getString("CarCategory");
                                //Toast.makeText(CarwashActivity.this, ""+object.getString("CarCategory"), Toast.LENGTH_SHORT).show();
                                ParseQuery<ParseObject> query2 = ParseQuery.getQuery("Users");
                                query2.whereEqualTo("FBID", object1.getString("FBID"));
                                query2.getFirstInBackground(new GetCallback<ParseObject>() {
                                    @Override
                                    public void done(ParseObject object, ParseException e) {
                                        if(e == null){
                                            processpayment(object.getString("PenaltyStatus"));
                                        }
                                    }
                                });

                            }else{
                                Toast.makeText(CarwashActivity.this, ""+object_id, Toast.LENGTH_SHORT).show();
                            }
                        }
                    });
                }else{
                    Toast.makeText(CarwashActivity.this, ""+object_id, Toast.LENGTH_SHORT).show();
                }
            }
        });
    }

    private void processpayment(String penaltyStatus) {
        if(CocheApplication.carCategory.compareToIgnoreCase("2 wheels")==0){
            if(penaltyStatus.compareToIgnoreCase("1")==0){
                payment = new PayPalPayment(new BigDecimal("100.00"), "PHP", "Coche. Carwash Payment",
                        PayPalPayment.PAYMENT_INTENT_SALE);
                amount = 100.00;
            }else{
                payment = new PayPalPayment(new BigDecimal("50.00"), "PHP", "Coche. Carwash Payment",
                        PayPalPayment.PAYMENT_INTENT_SALE);
                amount = 50.00;
            }
        }else{
            if(penaltyStatus.compareToIgnoreCase("1")==0){
                payment = new PayPalPayment(new BigDecimal("150.00"), "PHP", "Coche. Carwash Payment",
                        PayPalPayment.PAYMENT_INTENT_SALE);
                amount = 150.00;
            }else{
                payment = new PayPalPayment(new BigDecimal("100.00"), "PHP", "Coche. Carwash Payment",
                        PayPalPayment.PAYMENT_INTENT_SALE);
                amount = 100.00;
            }
        }

        Intent intent = new Intent(this, PaymentActivity.class);

        // send the same configuration for restart resiliency
        intent.putExtra(PayPalService.EXTRA_PAYPAL_CONFIGURATION, config);

        intent.putExtra(PaymentActivity.EXTRA_PAYMENT, payment);

        startActivityForResult(intent, PAYPAL_REQUEST_CODE);
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
                                                Toast.makeText(CarwashActivity.this, "Payment Successful.", Toast.LENGTH_SHORT).show();
                                                Intent intent = new Intent();
                                                intent.setClass(CarwashActivity.this, CarwashActivity.class);
                                                startActivity(intent);
                                                finish();
                                            }else{
                                                Toast.makeText(CarwashActivity.this, "Please check your internet connection", Toast.LENGTH_SHORT).show();
                                            }
                                        }
                                    });
                                }else{
                                    Toast.makeText(CarwashActivity.this, "Please check your internet connection.", Toast.LENGTH_SHORT).show();
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

    public void intentrepair(View v){
        Intent intent = new Intent(CarwashActivity.this, MainActivity.class);
        intent.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK | Intent.FLAG_ACTIVITY_CLEAR_TASK);
        startActivity(intent);
        finish();
        overridePendingTransition(R.anim.slide_in_right, R.anim.slide_out_left);
    }

    public void intenttow(View v){
        Intent intent = new Intent(CarwashActivity.this, TowActivity.class);
        intent.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK | Intent.FLAG_ACTIVITY_CLEAR_TASK);
        startActivity(intent);
        finish();
        overridePendingTransition(R.anim.slide_in_right, R.anim.slide_out_left);
    }

    public void intentprofile(View v){
        Intent intent = new Intent(CarwashActivity.this, ProfileActivity.class);
        intent.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK | Intent.FLAG_ACTIVITY_CLEAR_TASK);
        startActivity(intent);
        finish();
        overridePendingTransition(R.anim.slide_in_right, R.anim.slide_out_left);
    }


    private void inflateautolayout() {

        LayoutInflater factory = LayoutInflater.from(this);
        final View dialog = factory.inflate(R.layout.auto_layout, null);
        final androidx.appcompat.app.AlertDialog dialoglayout = new androidx.appcompat.app.AlertDialog.Builder(this, R.style.MyDialogTheme).create();
        dialoglayout.setView(dialog);

        final TextView companyName = dialog.findViewById(R.id.company_name);
        final TextView time = dialog.findViewById(R.id.time);
        Button btnConfirm = dialog.findViewById(R.id.btn_confirm);

        ParseQuery<ParseObject> query1 = ParseQuery.getQuery("Reservation");
        query1.whereEqualTo("Status", "Canceled");
        query1.whereEqualTo("ServiceType", "Carwash");
        query1.getFirstInBackground(new GetCallback<ParseObject>() {
            @Override
            public void done(ParseObject object, ParseException e) {
                if(e == null){
                    objectID = object.getObjectId();
                    time.setText(object.getString("Time")+" "+object.getString("Date"));
                    ParseQuery<ParseObject> query2 = ParseQuery.getQuery("Partner");
                    query2.whereEqualTo("objectId", object.getString("ObjectID"));
                    query2.getFirstInBackground(new GetCallback<ParseObject>() {
                        @Override
                        public void done(ParseObject object, ParseException e) {
                            companyName.setText(object.getString("CompanyName"));
                            prevTransaction.setVisibility(View.GONE);
                        }
                    });
                }
            }
        });

        btnConfirm.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                pd.setMessage("Saving new Reservation");
                pd.show();
                ParseQuery<ParseObject> query2 = ParseQuery.getQuery("Reservation");
                query2.whereEqualTo("FBID", CocheApplication.FBID);
                query2.getFirstInBackground(new GetCallback<ParseObject>() {
                    @Override
                    public void done(ParseObject object, ParseException e) {
                        if(e == null){
                            object.deleteInBackground(new DeleteCallback() {
                                @Override
                                public void done(ParseException e) {
                                    if(e == null){
                                        ParseQuery<ParseObject> query1 = ParseQuery.getQuery("Reservation");
                                        query1.whereEqualTo("objectId", objectID);
                                        query1.getFirstInBackground(new GetCallback<ParseObject>() {
                                            @Override
                                            public void done(ParseObject object, ParseException e) {
                                                if(e == null){
                                                    object.put("FBID", CocheApplication.FBID);
                                                    object.put("Status", "Approved");
                                                    object.saveInBackground();
                                                    pd.dismiss();
                                                    Toast.makeText(CarwashActivity.this, "Successfully Updated", Toast.LENGTH_SHORT).show();
                                                    dialoglayout.dismiss();
                                                    Intent intent = new Intent();
                                                    intent.setClass(CarwashActivity.this, CarwashActivity.class);
                                                    startActivity(intent);
                                                    finish();
                                                }
                                            }
                                        });
                                    }
                                }
                            });

                        }
                    }
                });


            }
        });






        dialoglayout.show();
    }

    @VisibleForTesting
    void showDate(int year, int monthOfYear, int dayOfMonth, int spinnerTheme) {
        new SpinnerDatePickerDialogBuilder()
                .context(this)
                .callback(this)
                .spinnerTheme(spinnerTheme)
                .defaultDate(year, monthOfYear, dayOfMonth)
                .build()
                .show();

    }


    @Override
    public void onConnectionSuspended(int i) {
        client.connect();
    }

    @Override
    public void onConnectionFailed(ConnectionResult connectionResult) {

    }

    @Override
    public void onLocationChanged(Location location) {
        lastlocation = location;
        displayLocation();
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
            mMap.setMyLocationEnabled(true);
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
                        ActivityCompat.requestPermissions(CarwashActivity.this,
                                new String[]{Manifest.permission.ACCESS_FINE_LOCATION}, PERMISSION_REQUEST_ACCESS_FINE_LOCATION);
                    }
                })
                .setNegativeButton("Cancel", new DialogInterface.OnClickListener() {
                    @Override
                    public void onClick(DialogInterface dialog, int which) {
                        Toast.makeText(CarwashActivity.this, "gps denied", Toast.LENGTH_SHORT).show();
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

                    mMap.setMinZoomPreference(15);

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
                            mMap.setMyLocationEnabled(true);
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
    public void onConnected(Bundle bundle) {
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

        pd.dismiss();

        final ParseQuery<ParseObject> query1 = ParseQuery.getQuery("Reservation");
        query1.whereEqualTo("FBID", CocheApplication.FBID);
        query1.whereEqualTo("ServiceType", "Carwash");
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
                              if(objects.get(i).get("PaymentStatus").toString().compareToIgnoreCase("NotPaid")==0 && objects.get(i).getString("Status").compareToIgnoreCase("Approved")==0){
                                  btnPaynow.setVisibility(View.VISIBLE);
                              }
                                ParseQuery<ParseObject> query2 = ParseQuery.getQuery("Partner");
                                query2.whereEqualTo("objectId", objects.get(i).getString("ObjectID"));
                                query2.whereEqualTo("Services", "Carwash");
                                final int finalI = i;
                                query2.getFirstInBackground(new GetCallback<ParseObject>() {
                                    @Override
                                    public void done(ParseObject object, ParseException e) {
                                        if(e == null){
                                            prevTransaction.setVisibility(View.VISIBLE);
                                            rvCarwash.setVisibility(View.GONE);
                                            object_id = objects.get(finalI).getObjectId();
                                            number = object.getString("Number");
                                            tvCompanyAddress.setText(object.getString("Address"));
                                            tvCompanyName.setText(object.getString("CompanyName"));
                                            Location location1 = new Location("Locationa1");
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
                            }
                        }
                    }
                }else{
                    Toast.makeText(CarwashActivity.this, "No Internet Connection", Toast.LENGTH_SHORT).show();
                }
            }
        });

        if(CocheApplication.data != null){
            inflateautolayout();
        }

//        ParseQuery<ParseObject> query1 = ParseQuery.getQuery("Reservation");
//        query1.whereEqualTo("FBID", CocheApplication.FBID);
//        query1.whereNotEqualTo("Status", "Canceled");
//        query1.getFirstInBackground(new GetCallback<ParseObject>() {
//            @Override
//            public void done(final ParseObject object1, ParseException e) {
//                if(e == null) {
//                    ParseQuery<ParseObject> query2 = ParseQuery.getQuery("Partner");
//                    query2.whereEqualTo("objectId", object1.getString("ObjectID"));
//                    query2.whereEqualTo("Services", "Carwash");
//                    query2.getFirstInBackground(new GetCallback<ParseObject>() {
//                        @Override
//                        public void done(ParseObject object, ParseException e) {
//                            if(e == null){
//                                prevTransaction.setVisibility(View.VISIBLE);
//                                rvCarwash.setVisibility(View.GONE);
//                                object_id = object1.getObjectId();
//                                tvCompanyAddress.setText(object.getString("Address"));
//                                tvCompanyName.setText(object.getString("CompanyName"));
//                                Location location1 = new Location("Locationa1");
//                                location1.setLatitude(lastlocation.getLatitude());
//                                location1.setLongitude(lastlocation.getLongitude());
//                                Location location2 = new Location("Location2");
//                                location2.setLatitude(Double.parseDouble(object.getString("Latitude")));
//                                location2.setLongitude(Double.parseDouble(object.getString("Longitude")));
//                                double distanceInMeters = location1.distanceTo(location2) / 1000;
//                                tvDistance.setText(String.format("%.2f",distanceInMeters)+" Kilometers");
//                            }else{
//                                Toast.makeText(CarwashActivity.this, "No Internet Connection"+CocheApplication.FBID, Toast.LENGTH_SHORT).show();
//                            }
//                        }
//                    });
//                }else{
//                    Toast.makeText(CarwashActivity.this, "No Internet Connection"+e, Toast.LENGTH_SHORT).show();
//                }
//            }
//        });



    }


    @Override
    public void onDateSet(com.tsongkha.spinnerdatepicker.DatePicker view, int year, int monthOfYear, int dayOfMonth) {
        calendar = new GregorianCalendar(year, monthOfYear, dayOfMonth);
        datepicker.setText(simpleDateFormat.format(calendar.getTime()));
        day = calendar.get(Calendar.DAY_OF_WEEK)-1;
        if(calendar.get(Calendar.YEAR) < Calendar.getInstance().get(Calendar.YEAR) || calendar.get(Calendar.MONTH) < Calendar.getInstance().get(Calendar.MONTH)
        || calendar.get(Calendar.DAY_OF_MONTH) < Calendar.getInstance().get(Calendar.DAY_OF_MONTH)){
            Toast.makeText(this, "Invalid date", Toast.LENGTH_SHORT).show();
            rvCarwash.setVisibility(View.GONE);
        }else{
            rvCarwash.setVisibility(View.VISIBLE);
            process();
        }
    }

    private void process() {
        if(day == 1){
            dayName = "Monday";
        }else if(day == 2){
            dayName = "Tuesday";
        }else if (day == 3){
            dayName = "Wednesday";
        }else if (day == 4){
            dayName = "Thursday";
        }else if (day == 5){
            dayName = "Friday";
        }else if (day == 6){
            dayName = "Saturday";
        }else if (day == 0){
            dayName = "Sunday";
        }

        //Toast.makeText(this, ""+dayName+ " "+CocheApplication.FBID, Toast.LENGTH_SHORT).show();
//
//        ParseQuery<ParseObject> query1 = ParseQuery.getQuery("Reservation");
//        //query1.whereNotEqualTo("Status", "Canceled");
//        query1.whereEqualTo("FBID", CocheApplication.FBID);
//        query1.findInBackground(new FindCallback<ParseObject>() {
//            @Override
//            public void done(final List<ParseObject> objects, ParseException e) {
//                if(e == null){
//                    for(int i=0; i<objects.size() ; i++){
//                        ParseQuery<ParseObject> query2 = ParseQuery.getQuery("Partner");
//                        query2.whereEqualTo("objectId", objects.get(i).getString("ObjectID"));
//                        query2.whereEqualTo("Services", "Carwash");
//                        final int finalI = i;
//                        query2.getFirstInBackground(new GetCallback<ParseObject>() {
//                            @Override
//                            public void done(ParseObject object, ParseException e) {
//                                if(e == null){
//                                    Toast.makeText(CarwashActivity.this, "ok1", Toast.LENGTH_SHORT).show();
//                                    prevTransaction.setVisibility(View.VISIBLE);
//                                    rvCarwash.setVisibility(View.GONE);
//                                    object_id = objects.get(finalI).getObjectId();
//                                    tvCompanyAddress.setText(object.getString("Address"));
//                                    tvCompanyName.setText(object.getString("CompanyName"));
//                                    number = object.getString("Number");
//                                    Location location1 = new Location("Locationa1");
//                                    location1.setLatitude(lastlocation.getLatitude());
//                                    location1.setLongitude(lastlocation.getLongitude());
//                                    Location location2 = new Location("Location2");
//                                    location2.setLatitude(Double.parseDouble(object.getString("Latitude")));
//                                    location2.setLongitude(Double.parseDouble(object.getString("Longitude")));
//                                    double distanceInMeters = location1.distanceTo(location2) / 1000;
//                                    tvDistance.setText(String.format("%.2f",distanceInMeters)+" Kilometers");
//                                }else{
//                                    Toast.makeText(CarwashActivity.this, "ok", Toast.LENGTH_SHORT).show();
//                                    ParseQuery<ParseObject> query = ParseQuery.getQuery("Partner");
//                                    query.whereEqualTo(dayName, "Open");
//                                    query.whereEqualTo("Services", "Carwash");
//                                    query.findInBackground(new FindCallback<ParseObject>() {
//                                        @Override
//                                        public void done(List<ParseObject> objects, ParseException e) {
//                                            if(e == null){
////                    for (int j = 0; j < objects.size(); j++)
////                    {
////                        //fetching data from parseObject
////                    }
//                                                //Toast.makeText(CarwashActivity.this, ""+objects.size(), Toast.LENGTH_SHORT).show();
//                                                carwashAdapter = new CarwashAdapter(CarwashActivity.this, objects, datepicker.getText().toString(), mMap, marker, lastlocation.getLatitude(), lastlocation.getLongitude());
//                                                RecyclerView.LayoutManager mLayoutManager = new LinearLayoutManager(CarwashActivity.this, LinearLayoutManager.HORIZONTAL, false);
//                                                rvCarwash.setLayoutManager(mLayoutManager);
//                                                rvCarwash.setItemAnimator(new DefaultItemAnimator());
//                                                rvCarwash.setAdapter(carwashAdapter);
//                                                carwashAdapter.notifyDataSetChanged();
//                                            }else{
//                                                Toast.makeText(CarwashActivity.this, ""+e, Toast.LENGTH_SHORT).show();
//                                            }
//                                        }
//                                    });
//                                }
//                            }
//                        });
//                    }
//                }else{
//
//                }
//            }
//        });

        //Toast.makeText(CarwashActivity.this, dayName, Toast.LENGTH_SHORT).show();
        ParseQuery<ParseObject> query = ParseQuery.getQuery("Partner");
        query.whereEqualTo(dayName, "Open");
        query.whereEqualTo("Services", "Carwash");
//        query.whereEqualTo("Status", "1");
//        query.whereNear("Location", parseGeoPoint);
        query.findInBackground(new FindCallback<ParseObject>() {
            @Override
            public void done(List<ParseObject> objects, ParseException e) {
                if(e == null){
//                    for (int j = 0; j < objects.size(); j++)
//                    {
//                        //fetching data from parseObject
//                    }
                    Toast.makeText(CarwashActivity.this, ""+objects.size(), Toast.LENGTH_SHORT).show();

                    carwashAdapter = new CarwashAdapter(CarwashActivity.this, objects, datepicker.getText().toString(), mMap, marker, calendar,lastlocation.getLatitude(), lastlocation.getLongitude(), currentLocationMarker);
                    RecyclerView.LayoutManager mLayoutManager = new LinearLayoutManager(CarwashActivity.this, LinearLayoutManager.HORIZONTAL, false);
                    rvCarwash.setLayoutManager(mLayoutManager);
                    rvCarwash.setItemAnimator(new DefaultItemAnimator());
                    rvCarwash.setAdapter(carwashAdapter);
                    carwashAdapter.notifyDataSetChanged();
                }else{
                    Toast.makeText(CarwashActivity.this, ""+e, Toast.LENGTH_SHORT).show();
                }
            }
        });
//
//        ParseQuery<ParseObject> query1 = ParseQuery.getQuery("Reservation");
//        query1.whereEqualTo("FBID", CocheApplication.FBID);
//        query1.whereNotEqualTo("Status", "Canceled");
//        query1.getFirstInBackground(new GetCallback<ParseObject>() {
//            @Override
//            public void done(final ParseObject object1, ParseException e) {
//                if(e == null) {
//                    ParseQuery<ParseObject> query2 = ParseQuery.getQuery("Partner");
//                    query2.whereEqualTo("objectId", object1.getString("ObjectID"));
//                    query2.whereEqualTo("Services", "Carwash");
//                    query2.getFirstInBackground(new GetCallback<ParseObject>() {
//                        @Override
//                        public void done(ParseObject object, ParseException e) {
//                            if(e == null){
//                                prevTransaction.setVisibility(View.VISIBLE);
//                                rvCarwash.setVisibility(View.GONE);
//                                object_id = object1.getObjectId();
//                                tvCompanyAddress.setText(object.getString("Address"));
//                                tvCompanyName.setText(object.getString("CompanyName"));
//                                Location location1 = new Location("Locationa1");
//                                location1.setLatitude(lastlocation.getLatitude());
//                                location1.setLongitude(lastlocation.getLongitude());
//                                Location location2 = new Location("Location2");
//                                location2.setLatitude(Double.parseDouble(object.getString("Latitude")));
//                                location2.setLongitude(Double.parseDouble(object.getString("Longitude")));
//                                double distanceInMeters = location1.distanceTo(location2) / 1000;
//                                tvDistance.setText(String.format("%.2f",distanceInMeters)+" Kilometers");
//                            }else{
//                                ParseQuery<ParseObject> query = ParseQuery.getQuery("Partner");
//                                query.whereEqualTo(dayName, "Open");
//                                query.findInBackground(new FindCallback<ParseObject>() {
//                                    @Override
//                                    public void done(List<ParseObject> objects, ParseException e) {
//                                        if(e == null){
////                    for (int j = 0; j < objects.size(); j++)
////                    {
////                        //fetching data from parseObject
////                    }
//                                            //Toast.makeText(CarwashActivity.this, ""+objects.size(), Toast.LENGTH_SHORT).show();
//                                            carwashAdapter = new CarwashAdapter(CarwashActivity.this, objects, datepicker.getText().toString(), mMap, marker, lastlocation.getLatitude(), lastlocation.getLongitude());
//                                            RecyclerView.LayoutManager mLayoutManager = new LinearLayoutManager(CarwashActivity.this, LinearLayoutManager.HORIZONTAL, false);
//                                            rvCarwash.setLayoutManager(mLayoutManager);
//                                            rvCarwash.setItemAnimator(new DefaultItemAnimator());
//                                            rvCarwash.setAdapter(carwashAdapter);
//                                            carwashAdapter.notifyDataSetChanged();
//                                        }else{
//                                            Toast.makeText(CarwashActivity.this, ""+e, Toast.LENGTH_SHORT).show();
//                                        }
//                                    }
//                                });
//                            }
//                        }
//                    });
//                }else{
//                    ParseQuery<ParseObject> query = ParseQuery.getQuery("Partner");
//                    query.whereEqualTo(dayName, "Open");
//                    query.findInBackground(new FindCallback<ParseObject>() {
//                        @Override
//                        public void done(List<ParseObject> objects, ParseException e) {
//                            if(e == null){
////                    for (int j = 0; j < objects.size(); j++)
////                    {
////                        //fetching data from parseObject
////                    }
//                                //Toast.makeText(CarwashActivity.this, ""+objects.size(), Toast.LENGTH_SHORT).show();
//                                carwashAdapter = new CarwashAdapter(CarwashActivity.this, objects, datepicker.getText().toString(), mMap, marker, lastlocation.getLatitude(), lastlocation.getLongitude());
//                                RecyclerView.LayoutManager mLayoutManager = new LinearLayoutManager(CarwashActivity.this, LinearLayoutManager.HORIZONTAL, false);
//                                rvCarwash.setLayoutManager(mLayoutManager);
//                                rvCarwash.setItemAnimator(new DefaultItemAnimator());
//                                rvCarwash.setAdapter(carwashAdapter);
//                                carwashAdapter.notifyDataSetChanged();
//                            }else{
//                                Toast.makeText(CarwashActivity.this, ""+e, Toast.LENGTH_SHORT).show();
//                            }
//                        }
//                    });
//                }
//            }
//        });
        //ToastToast.makeText(this, ""+day, Toast.LENGTH_SHORT).show();

    }

}
