package com.coche.usc.adapter;

import android.content.Context;
import android.content.Intent;
import android.location.Location;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.Spinner;
import android.widget.TextView;
import android.widget.Toast;

import androidx.appcompat.app.AlertDialog;
import androidx.recyclerview.widget.RecyclerView;

import com.coche.usc.CocheApplication;
import com.coche.usc.activity.ReservationActivity;
import com.google.android.gms.maps.CameraUpdate;
import com.google.android.gms.maps.CameraUpdateFactory;
import com.google.android.gms.maps.GoogleMap;
import com.google.android.gms.maps.model.BitmapDescriptorFactory;
import com.google.android.gms.maps.model.LatLng;
import com.google.android.gms.maps.model.LatLngBounds;
import com.google.android.gms.maps.model.Marker;
import com.google.android.gms.maps.model.MarkerOptions;
import com.google.firebase.FirebaseApp;
import com.google.firebase.database.DatabaseReference;
import com.google.firebase.database.FirebaseDatabase;
import com.parse.FindCallback;
import com.parse.ParseException;
import com.parse.ParseObject;
import com.parse.ParseQuery;

import java.util.ArrayList;
import java.util.List;

import co.coche.usc.R;

/**
 * Created by Bliss Massage on 04/10/2019.
 */

public class RepairAdapter extends RecyclerView.Adapter<RepairAdapter.RepairHolder> {

    private List<ParseObject> itemlist;
    private Context mContext;
    private GoogleMap map;
    private Marker marker, currentLocationMarker;
    private LatLng location;
    private double latitude, longitude;
    FirebaseDatabase database = FirebaseDatabase.getInstance();
    DatabaseReference myRef = database.getReference("message");

    private ArrayList<String> plate = new ArrayList<>();

    public RepairAdapter(Context context, List<ParseObject> itemlist, GoogleMap mMap, Marker marker, double latitude, double longitude, Marker currentLocationMarker) {
        this.itemlist = itemlist;
        this.mContext = context;
        this.map = mMap;
        this.marker = marker;
        this.latitude = latitude;
        this.longitude = longitude;
        this.currentLocationMarker = currentLocationMarker;
    }


    public class RepairHolder extends RecyclerView.ViewHolder {

        private Button btnLocate, btnReserve;
        private TextView tvCompanyName, tvCompanyAddress, tvDistance;


        public RepairHolder(View view) {
            super(view);

            btnLocate = view.findViewById(R.id.btn_locate);
            btnReserve = view.findViewById(R.id.btn_reserve);

            tvCompanyName = view.findViewById(R.id.company_id);
            tvCompanyAddress = view.findViewById(R.id.company_address);
            tvDistance = view.findViewById(R.id.distance);

        }
    }

    @Override
    public RepairHolder onCreateViewHolder( ViewGroup parent, int viewType) {
        View itemView = LayoutInflater.from(parent.getContext())
                .inflate(R.layout.suggested_repair_location, parent, false);
        FirebaseApp.initializeApp(mContext);
        return new RepairHolder(itemView);
    }

    @Override
    public void onBindViewHolder(RepairHolder holder, final int position) {

        holder.tvCompanyName.setText(itemlist.get(position).getString("CompanyName"));
        holder.tvCompanyAddress.setText(itemlist.get(position).getString("Address"));

        Location location1 = new Location("Locationa1");
        location1.setLatitude(latitude);
        location1.setLongitude(longitude);
        Location location2 = new Location("Location2");
        location2.setLatitude(itemlist.get(position).getParseGeoPoint("Location").getLatitude());
        location2.setLongitude(itemlist.get(position).getParseGeoPoint("Location").getLongitude());
        double distanceInMeters = location1.distanceTo(location2) / 1000;
        holder.tvDistance.setText(""+ String.format("%.2f",distanceInMeters)+" Kilometers");


        holder.btnReserve.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                CocheApplication.companyId = itemlist.get(position).getObjectId();
                CocheApplication.serviceType = itemlist.get(position).getString("Services");
                inflatelayout();
            }
        });

        holder.btnLocate.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {

                    if(marker != null){
                     marker.remove();
                    }

                location = new LatLng(itemlist.get(position).getParseGeoPoint("Location").getLatitude(), itemlist.get(position).getParseGeoPoint("Location").getLongitude());
                    //location = new LatLng(Double.parseDouble(itemlist.get(position).getString("Latitude")), Double.parseDouble(itemlist.get(position).getString("Longitude")));
                    marker = map.addMarker(new MarkerOptions().position(location)
                            .flat(true)
                            .icon(BitmapDescriptorFactory.fromResource(R.drawable.marker_repair)));



                    marker.setPosition(location);

                LatLngBounds.Builder builder = new LatLngBounds.Builder();
                builder.include(marker.getPosition());
                builder.include(currentLocationMarker.getPosition());

                LatLngBounds bounds = builder.build();
                int width = mContext.getResources().getDisplayMetrics().widthPixels;
                int height = mContext.getResources().getDisplayMetrics().heightPixels;
                int padding = (int) (height * 0.20); // offset from edges of the map 10% of screen

                CameraUpdate cu = CameraUpdateFactory.newLatLngBounds(bounds, width, height, padding);
                map.animateCamera(cu);

            }
        });
    }

    private void inflatelayout() {
        LayoutInflater factory = LayoutInflater.from(mContext);
        final View dialog = factory.inflate(R.layout.dialog_select_car, null);
        final AlertDialog dialoglayout = new AlertDialog.Builder(mContext, R.style.MyDialogTheme).create();
        dialoglayout.setView(dialog);

        final Spinner selectPlatNumber = dialog.findViewById(R.id.spinner_car);
        Button btnSubmit = dialog.findViewById(R.id.btn_submit);

        ParseQuery<ParseObject> query1 = ParseQuery.getQuery("Car");
        query1.whereEqualTo("ObjectID", CocheApplication.FBID);
        query1.findInBackground(new FindCallback<ParseObject>() {
            @Override
            public void done(List<ParseObject> objects, ParseException e) {
                if(e == null){
                    for(int i = 0; i<objects.size();i++){
                        plate.add(objects.get(i).getString("CarPlateNumber"));
                    }
                    ArrayAdapter<String> adapter1 = new ArrayAdapter<>(mContext, android.R.layout.simple_spinner_dropdown_item, plate);
                    selectPlatNumber.setAdapter(adapter1);
                }else{
                    Toast.makeText(mContext, "No Internet Connection", Toast.LENGTH_SHORT).show();
                }
            }
        });

        btnSubmit.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                dialoglayout.dismiss();
                CocheApplication.carPlateNumber = selectPlatNumber.getSelectedItem().toString();
                Intent intent = new Intent();
                intent.setClass(mContext, ReservationActivity.class);
                mContext.startActivity(intent);
            }
        });

        dialoglayout.show();

    }

    @Override
    public int getItemCount() {
        return itemlist.size();
    }

}
