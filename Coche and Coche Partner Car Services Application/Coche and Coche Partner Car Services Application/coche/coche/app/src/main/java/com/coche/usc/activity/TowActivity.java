package com.coche.usc.activity;

import android.Manifest;
import android.app.AlertDialog;
import android.app.ProgressDialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.pm.PackageManager;
import android.location.Location;
import android.net.Uri;
import android.os.Handler;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.FrameLayout;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.TextView;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;
import androidx.core.app.ActivityCompat;
import androidx.core.content.ContextCompat;
import androidx.recyclerview.widget.RecyclerView;

import com.coche.usc.CocheApplication;
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
import com.parse.GetCallback;
import com.parse.Parse;

import co.coche.usc.R;
import com.coche.usc.adapter.RepairAdapter;
import com.parse.ParseException;
import com.parse.ParseObject;
import com.parse.ParseQuery;

public class TowActivity extends AppCompatActivity implements OnMapReadyCallback,
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
    private Button btnContact;

    private RecyclerView rvRepair;
    private RepairAdapter repairAdapter;
    private ImageView imgCarwash, imgTow;
    private ProgressDialog dialogFind;
    private FrameLayout towInfo;
    private TextView tvCompanyName, tvCompanyAddress, tvDistance;
    private LinearLayout linTow;

    private ImageView btnRepair, btnCarwash, btnProfile;

    private static int UPDATE_INTERVAL = 5000;
    private static int FASTEST_INTERVAL = 3000;
    private static int DISTANCE = 10;
    private String number;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_tow);

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
        SupportMapFragment mapFragment = (SupportMapFragment) getSupportFragmentManager()
                .findFragmentById(R.id.map);
        mapFragment.getMapAsync(this);

        towInfo = findViewById(R.id.frame_tow_info);
        btnRepair = findViewById(R.id.btn_repair);
        btnCarwash = findViewById(R.id.btn_carwash);
        btnProfile = findViewById(R.id.btn_profile);
        tvCompanyAddress = findViewById(R.id.company_address);
        tvCompanyName = findViewById(R.id.company_name);
        tvDistance = findViewById(R.id.distance);
        btnContact = findViewById(R.id.btn_contact);
        linTow = findViewById(R.id.lin_tow);

        linTow.setBackgroundColor(getResources().getColor(R.color.orange));

        btnContact.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent callIntent = new Intent(Intent.ACTION_CALL);
                callIntent.setData(Uri.parse("tel:"+number));
                startActivity(callIntent);
            }
        });


        dialogFind =  ProgressDialog.show(TowActivity.this, "",
                "Looking for Nearest Tow Company....", true);
    }

    public void intentprofile(View v){
        Intent intent = new Intent(TowActivity.this, ProfileActivity.class);
        intent.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK | Intent.FLAG_ACTIVITY_CLEAR_TASK);
        startActivity(intent);
        finish();
        overridePendingTransition(R.anim.slide_in_right, R.anim.slide_out_left);
    }

    public void intentcarwash(View v){
        Intent intent = new Intent(TowActivity.this, CarwashActivity.class);
        intent.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK | Intent.FLAG_ACTIVITY_CLEAR_TASK);
        startActivity(intent);
        finish();
        overridePendingTransition(R.anim.slide_in_right, R.anim.slide_out_left);
    }

    public void intentrepair(View v){
        Intent intent = new Intent(TowActivity.this, MainActivity.class);
        intent.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK | Intent.FLAG_ACTIVITY_CLEAR_TASK);
        startActivity(intent);
        finish();
        overridePendingTransition(R.anim.slide_in_right, R.anim.slide_out_left);
    }

    private void dialog() {
        new AlertDialog.Builder(this)
                .setPositiveButton("ACCEPT", new DialogInterface.OnClickListener() {
                    @Override
                    public void onClick(DialogInterface dialog, int which) {
                        dialog.dismiss();
                    }
                })
                .setCancelable(false)
                .setTitle("Tow Company")
                .setMessage("We have found the nearest tow company in your location")
                .show();
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
        final LatLng latLng = new LatLng(lastlocation.getLatitude(), lastlocation.getLongitude());

        if (currentLocationMarker != null) {
            currentLocationMarker.remove();
        }

        currentLocationMarker = mMap.addMarker(new MarkerOptions()
                .icon(BitmapDescriptorFactory.fromResource(R.drawable.marker))
                .position(latLng).title("Your current location"));

        if (FIRST_LOCATION_RECEIVE) {

            mMap.animateCamera(CameraUpdateFactory.newLatLngZoom(latLng, 11));
            FIRST_LOCATION_RECEIVE = false;
            process();
        }

    }

    private void process() {
        ParseQuery<ParseObject> query1 = ParseQuery.getQuery("Partner");
        query1.whereEqualTo("Services", "Towing");
        query1.getFirstInBackground(new GetCallback<ParseObject>() {
            @Override
            public void done(ParseObject object, ParseException e) {
                if(e == null){
//                    ParseQuery<ParseObject> query = ParseQuery.getQuery("Partner");
//                    query.whereEqualTo("objectId", object.getString("ObjectID"));
//                    query.getFirstInBackground(new GetCallback<ParseObject>() {
//                        @Override
//                        public void done(ParseObject object, ParseException e) {
//                            if(e == null){
                    towInfo.setVisibility(View.VISIBLE);
                    dialogFind.dismiss();
                    dialog();
                    number = object.getString("Number");
                    tvCompanyName.setText(object.getString("CompanyName"));
                    tvCompanyAddress.setText(object.getString("Address"));
                    Location location1 = new Location("Locationa1");
                    location1.setLatitude(lastlocation.getLatitude());
                    location1.setLongitude(lastlocation.getLongitude());
                    Location location2 = new Location("Location2");
                    location2.setLatitude(Double.parseDouble(object.getString("Latitude")));
                    location2.setLongitude(Double.parseDouble(object.getString("Longitude")));
                    LatLng latLng =  new LatLng(location2.getLatitude(), location2.getLongitude());
                    double distanceInMeters = location1.distanceTo(location2) / 1000;
                    tvDistance.setText(String.format("%.2f",distanceInMeters)+" Kilometers");
                    marker = mMap.addMarker(new MarkerOptions().position(latLng)
                            .flat(true)
                            .icon(BitmapDescriptorFactory.fromResource(R.drawable.marker_repair)));

                    marker.setPosition(latLng);
//                            }else{
//                                Toast.makeText(TowActivity.this, "No Internet Connection", Toast.LENGTH_SHORT).show();
//                                dialogFind.dismiss();
//                            }
//                        }
//                    });
                }else{
                    Toast.makeText(TowActivity.this, "No Internet Connection or No Tow Company available", Toast.LENGTH_SHORT).show();
                    dialogFind.dismiss();

                }

            }
        });

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
                        ActivityCompat.requestPermissions(TowActivity.this,
                                new String[]{Manifest.permission.ACCESS_FINE_LOCATION}, PERMISSION_REQUEST_ACCESS_FINE_LOCATION);
                    }
                })
                .setNegativeButton("Cancel", new DialogInterface.OnClickListener() {
                    @Override
                    public void onClick(DialogInterface dialog, int which) {
                        Toast.makeText(TowActivity.this, "gps denied", Toast.LENGTH_SHORT).show();
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

                    mMap.setMinZoomPreference(12);

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
}
