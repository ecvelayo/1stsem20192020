package com.coche.usc.adapter;

import android.app.ProgressDialog;
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
import com.coche.usc.activity.CarwashActivity;
import com.coche.usc.activity.Model.User;
import com.google.android.gms.maps.CameraUpdate;
import com.google.android.gms.maps.CameraUpdateFactory;
import com.google.android.gms.maps.GoogleMap;
import com.google.android.gms.maps.model.BitmapDescriptorFactory;
import com.google.android.gms.maps.model.LatLng;
import com.google.android.gms.maps.model.LatLngBounds;
import com.google.android.gms.maps.model.Marker;
import com.google.android.gms.maps.model.MarkerOptions;
import com.google.firebase.database.FirebaseDatabase;
import com.parse.FindCallback;
import com.parse.GetCallback;
import com.parse.ParseException;
import com.parse.ParseObject;
import com.parse.ParseQuery;
import com.parse.SaveCallback;

import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Calendar;
import java.util.Date;
import java.util.List;

import co.coche.usc.R;

/**
 * Created by Bliss Massage on 04/10/2019.
 */

public class CarwashAdapter extends RecyclerView.Adapter<CarwashAdapter.CarwashHolder> {

    private List<ParseObject> itemlist;
    private Context mContext;
    private ArrayList<String> time = new ArrayList<>();
    private ArrayList<String> time_1 = new ArrayList<>();
    private ArrayList<String> plate = new ArrayList<>();
    private ArrayList<String> services = new ArrayList<>();

    private String time_picker, objectid;
    private Marker marker;
    private LatLng location;
    private GoogleMap map;
    private double latitude, longitude;
    private ProgressDialog pd;
    private Marker currentLocationMarker;
    private Calendar calendar;
    private int count = 0;

    public CarwashAdapter(Context context, List<ParseObject> itemlist, String time, GoogleMap mMap, Marker marker, Calendar calendar, double latitude, double longitude, Marker currentLocationMarker) {
        this.itemlist = itemlist;
        this.mContext = context;
        this.time_picker = time;
        this.latitude = latitude;
        this.longitude = longitude;
        this.marker = marker;
        this.map = mMap;
        this.currentLocationMarker = currentLocationMarker;
        this.calendar = calendar;
    }


    @Override
    public CarwashHolder onCreateViewHolder( ViewGroup parent, int viewType) {
        View itemView = LayoutInflater.from(parent.getContext())
                .inflate(R.layout.suggested_repair_location, parent, false);

        return new CarwashHolder(itemView);
    }

    @Override
    public void onBindViewHolder(CarwashHolder holder, final int position) {

        holder.tvCompanyName.setText(itemlist.get(position).getString("CompanyName"));
        holder.tvCompanyAddress.setText(itemlist.get(position).getString("Address"));
        CocheApplication.companyId = itemlist.get(position).getObjectId();

        Location location1 = new Location("Locationa1");
        location1.setLatitude(latitude);
        location1.setLongitude(longitude);
        Location location2 = new Location("Location2");
        location2.setLatitude(itemlist.get(position).getParseGeoPoint("Location").getLatitude());
        location2.setLongitude(itemlist.get(position).getParseGeoPoint("Location").getLongitude());
        double distanceInMeters = location1.distanceTo(location2) / 1000;
        holder.tvDistance.setText(""+ String.format("%.2f",distanceInMeters)+" Kilometers");


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

        holder.btnReserve.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                time.clear();
                time_1.clear();

                time.add("Select Time");
                time.add("8:00 am");
                time.add("9:00 am");
                time.add("10:00 am");
                time.add("11:00 am");
                time.add("12:00 pm");
                time.add("1:00 pm");
                time.add("2:00 pm");
                time.add("3:00 pm");
                time.add("4:00 pm");
                time.add("5:00 pm");
                time.add("6:00 pm");
                time.add("7:00 pm");
                time.add("8:00 pm");
                time.add("9:00 pm");
                time.add("11:55 pm");


                LayoutInflater factory = LayoutInflater.from(mContext);
                View dialog = factory.inflate(R.layout.dialog_time, null);
                AlertDialog dialoglayout = new AlertDialog.Builder(mContext, R.style.MyDialogTheme).create();
                dialoglayout.setView(dialog);

                ArrayAdapter<String> adapter1 = new ArrayAdapter<>(mContext, android.R.layout.simple_spinner_dropdown_item, time);

                final Spinner timeSpinner = dialog.findViewById(R.id.spinner_time);
                final Spinner carSpinner = dialog.findViewById(R.id.spinner_car);
                final Spinner serviceSpinner = dialog.findViewById(R.id.spinner_service);
                timeSpinner.setAdapter(adapter1);

                ParseQuery<ParseObject> query1 = ParseQuery.getQuery("Services");
                query1.whereEqualTo("ObjectID", itemlist.get(position).getObjectId());
                query1.findInBackground(new FindCallback<ParseObject>() {
                    @Override
                    public void done(List<ParseObject> objects, ParseException e) {
                        if(e == null){
                            for(int i = 0; i<objects.size();i++){
                                services.add(objects.get(i).getString("ServiceName"));
                            }
                            ArrayAdapter<String> adapter1 = new ArrayAdapter<>(mContext, android.R.layout.simple_spinner_dropdown_item, services);
                            serviceSpinner.setAdapter(adapter1);
                        }else{
                            Toast.makeText(mContext, "No Internet Connection", Toast.LENGTH_SHORT).show();
                        }
                    }
                });

                ParseQuery<ParseObject> query2 = ParseQuery.getQuery("Car");
                query2.whereEqualTo("ObjectID", CocheApplication.FBID);
                query2.findInBackground(new FindCallback<ParseObject>() {
                    @Override
                    public void done(List<ParseObject> objects, ParseException e) {
                        if(e == null){
                            for(int i = 0; i<objects.size();i++){
                                plate.add(objects.get(i).getString("CarPlateNumber"));
                            }
                            ArrayAdapter<String> adapter1 = new ArrayAdapter<>(mContext, android.R.layout.simple_spinner_dropdown_item, plate);
                            carSpinner.setAdapter(adapter1);
                        }else{
                            Toast.makeText(mContext, "No Internet Connection", Toast.LENGTH_SHORT).show();
                        }
                    }
                });

                objectid = itemlist.get(position).getObjectId();
//                ParseQuery<ParseObject> query = ParseQuery.getQuery("Reservation");
//                query.whereEqualTo("ObjectID", objectid);
//                query.whereNotEqualTo("Status", "Canceled");
//                query.findInBackground(new FindCallback<ParseObject>() {
//                    @Override
//                    public void done(List<ParseObject> objects, ParseException e) {
//                        if(e == null){
//                            for(int i = 0; i < objects.size(); i++) {
////                            if(objects.get(i).get(""))
//                                time_1.add(objects.get(i).getString("Time"));
//                                Toast.makeText(mContext, ""+objects.get(i).getString("Time"), Toast.LENGTH_SHORT).show();
//                            }
//                            //Toast.makeText(mContext, ""+time_1.size(), Toast.LENGTH_SHORT).show();
//                            for(int i = 0; i<time_1.size(); i++){
//                                for(int j =1 ;j <time.size();j++){
//                                    if(time_1.get(i).compareToIgnoreCase(time.get(j))==0){
//                                        time.remove(j);
//                                    }
//                                }
//
//                            }
//                        }else{
//
//                        }
//
//                    }
//                });

                dialog.findViewById(R.id.btn_submit).setOnClickListener(new View.OnClickListener() {
                    @Override
                    public void onClick(View view) {

                        pd = new ProgressDialog(mContext);
                        pd.setMessage("Please wait...");
                        pd.show();

                        ParseQuery<ParseObject> query1 = ParseQuery.getQuery("Car");
                        query1.whereEqualTo("CarPlateNumber", carSpinner.getSelectedItem().toString());
                       query1.getFirstInBackground(new GetCallback<ParseObject>() {
                           @Override
                           public void done(ParseObject object, ParseException e) {
                                if(e == null){
                                    CocheApplication.carCategory = carSpinner.getSelectedItem().toString();
                                }else{
                                    Toast.makeText(mContext, "No internet connection", Toast.LENGTH_SHORT).show();
                                }
                           }
                       });

                        ParseQuery<ParseObject> query2 = ParseQuery.getQuery("Reservation");
                        query2.whereEqualTo("FBID", CocheApplication.FBID);
                        query2.whereEqualTo("CarPlateNumber", carSpinner.getSelectedItem().toString());
                        query2.whereEqualTo("Time", timeSpinner.getSelectedItem().toString());
                        query2.whereEqualTo("Status", "Approved");
                        query2.findInBackground(new FindCallback<ParseObject>() {
                            @Override
                            public void done(List<ParseObject> objects, ParseException e) {
                                if(e == null){
                                   if(objects.size() == 0){
                                       checkpending(timeSpinner, carSpinner, serviceSpinner,itemlist.get(position).getString("Services"));

                                   }else{
                                       Toast.makeText(mContext, "You already have reservation on this time and date"+count, Toast.LENGTH_SHORT).show();
                                       pd.dismiss();
                                   }

                                }else{
                                    checkpending(timeSpinner, carSpinner, serviceSpinner, itemlist.get(position).getString("Services"));
                                    Toast.makeText(mContext, "No Internet Connection", Toast.LENGTH_SHORT).show();
                                }
                            }
                        });


                    }
                });

                dialoglayout.show();

            }
        });



    }

    private void checkpending(final Spinner timeSpinner, final Spinner carSpinner, final Spinner serviceSpinner, final String services) {
        ParseQuery<ParseObject> query2 = ParseQuery.getQuery("Reservation");
        query2.whereEqualTo("FBID", CocheApplication.FBID);
        query2.whereEqualTo("CarPlateNumber", carSpinner.getSelectedItem().toString());
        query2.whereEqualTo("Time", timeSpinner.getSelectedItem().toString());
        query2.whereEqualTo("Status", "Pending");
        query2.findInBackground(new FindCallback<ParseObject>() {
            @Override
            public void done(List<ParseObject> objects, ParseException e) {
                if(e == null){
                    pd.dismiss();
                    if(objects.size() == 0){
                        process(carSpinner,serviceSpinner, timeSpinner, services);

                    }else{
                        pd.dismiss();
                        Toast.makeText(mContext, "You already have reservation on this time and date", Toast.LENGTH_SHORT).show();
                    }

                }else{
                    pd.dismiss();
                    Toast.makeText(mContext, "No Internet Connection", Toast.LENGTH_SHORT).show();
                }
            }
        });

    }

    private void process(Spinner carSpinner, Spinner serviceSpinner, Spinner timeSpinner, String services) {
        if(timeSpinner.getSelectedItemPosition() == 0){
            pd.dismiss();
            Toast.makeText(mContext, "Please Select Time", Toast.LENGTH_SHORT).show();
        }else{
            try {
                Date mToday = new Date();
                SimpleDateFormat sdf = new SimpleDateFormat("hh:mm aa");
                String curTime = sdf.format(mToday);
                Date yourtime = sdf.parse(curTime);
                Date selectedtime = sdf.parse(timeSpinner.getSelectedItem().toString());
                if(selectedtime.before(yourtime) && calendar.get(Calendar.YEAR) == Calendar.getInstance().get(Calendar.YEAR) && calendar.get(Calendar.MONTH) == Calendar.getInstance().get(Calendar.MONTH)+1
                        && calendar.get(Calendar.DAY_OF_MONTH) == Calendar.getInstance().get(Calendar.DAY_OF_MONTH)){
                    pd.dismiss();
                    Toast.makeText(mContext, "invalid time", Toast.LENGTH_SHORT).show();
                }else{
                    CocheApplication.firebaseDatabase = FirebaseDatabase.getInstance();
                    CocheApplication.sendstatus = CocheApplication.firebaseDatabase.getReference("Reservation").child(CocheApplication.companyId);
                    String id = CocheApplication.sendstatus.push().getKey();
                    User user = new User(CocheApplication.FBID);
                    CocheApplication.sendstatus.child(id).setValue(user);
                    Date c = Calendar.getInstance().getTime();
                    System.out.println("Current time => " + c);

                    SimpleDateFormat df = new SimpleDateFormat("dd-MMM-yyyy hh:mm aaa");
                    String createdAt = df.format(c);

                    ParseObject reservation = new ParseObject("Reservation");
                    reservation.put("FBID", CocheApplication.FBID);
                    reservation.put("Date", time_picker);
                    reservation.put("Time", timeSpinner.getSelectedItem().toString());
                    reservation.put("ObjectID", objectid);
                    reservation.put("ServiceType", services);
                    reservation.put("Service", serviceSpinner.getSelectedItem().toString());
                    reservation.put("Status", "Pending");
                    reservation.put("CarPlateNumber", carSpinner.getSelectedItem().toString());
                    reservation.put("Amount", "0.00");
                    reservation.put("PaymentStatus", "NotPaid");
                    reservation.put("created_at", createdAt);
                    reservation.put("updated_at", createdAt);

                    reservation.saveInBackground(new SaveCallback() {
                        @Override
                        public void done(ParseException e) {
                            if (e == null){
                                pd.dismiss();
                                Toast.makeText(mContext, "Successfully Reserved. Please wait for the company's approval of your reservation", Toast.LENGTH_SHORT).show();
                                Intent intent = new Intent();
                                intent.setClass(mContext, CarwashActivity.class);
                                time.clear();
                                time_1.clear();
                                mContext.startActivity(intent);
                            }else{
                                pd.dismiss();
                                Toast.makeText(mContext, "No Internet Connection", Toast.LENGTH_SHORT).show();
                            }
                        }
                    });
                }
            } catch (java.text.ParseException e) {
                pd.dismiss();
                Toast.makeText(mContext, ""+e, Toast.LENGTH_SHORT).show();
            }
        }
    }

    @Override
    public int getItemCount() {
        return itemlist.size();
    }


    public class CarwashHolder extends RecyclerView.ViewHolder {

        private Button btnLocate, btnReserve;
        private TextView tvCompanyName, tvCompanyAddress, tvDistance;

        public CarwashHolder(View view) {
            super(view);

            btnReserve = view.findViewById(R.id.btn_reserve);
            tvCompanyName = view.findViewById(R.id.company_id);
            tvCompanyAddress = view.findViewById(R.id.company_address);
            tvDistance = view.findViewById(R.id.distance);
            btnLocate = view.findViewById(R.id.btn_locate);
        }
    }
}
