package com.coche.usc.activity;

import androidx.appcompat.app.AppCompatActivity;

import android.app.ProgressDialog;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.DatePicker;
import android.widget.Spinner;
import android.widget.Toast;

import com.coche.usc.CocheApplication;
import com.coche.usc.activity.Model.User;
import com.google.firebase.database.FirebaseDatabase;
import com.parse.FindCallback;
import com.parse.ParseException;
import com.parse.ParseObject;
import com.parse.ParseQuery;
import com.parse.SaveCallback;

import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Calendar;
import java.util.Date;
import java.util.GregorianCalendar;
import java.util.List;

import co.coche.usc.R;

public class ReservationActivity extends AppCompatActivity {

    private DatePicker dateReservation;
    private Spinner time, services;
    private Button btnSubmit;
    private ProgressDialog pd;
    private ArrayList<String> reservationTime = new ArrayList<>();
    private ArrayList<String> servicesName = new ArrayList<>();

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_reservation);

        setupviews();
    }

    private void setupviews() {
        dateReservation = findViewById(R.id.date_reservation);
        time = findViewById(R.id.spinner_time);
        btnSubmit = findViewById(R.id.btn_submit);
        services = findViewById(R.id.spinner_services);

        reservationTime.add("Select Time");
        reservationTime.add("8:00 am");
        reservationTime.add("9:00 am");
        reservationTime.add("10:00 am");
        reservationTime.add("11:00 am");
        reservationTime.add("12:00 pm");
        reservationTime.add("1:00 pm");
        reservationTime.add("2:00 pm");
        reservationTime.add("3:00 pm");
        reservationTime.add("4:00 pm");
        reservationTime.add("5:00 pm");
        reservationTime.add("6:00 pm");
        reservationTime.add("7:00 pm");
        reservationTime.add("8:00 pm");
        reservationTime.add("9:00 pm");
        reservationTime.add("11:00 pm");

        ParseQuery<ParseObject> query1 = ParseQuery.getQuery("Services");
        query1.whereEqualTo("ObjectID", CocheApplication.companyId);
        query1.findInBackground(new FindCallback<ParseObject>() {
            @Override
            public void done(List<ParseObject> objects, ParseException e) {
                if(e == null){
                    for(int i = 0; i<objects.size();i++){
                        servicesName.add(objects.get(i).getString("ServiceName"));
                    }
                    ArrayAdapter<String> adapter1 = new ArrayAdapter<>(ReservationActivity.this, android.R.layout.simple_spinner_dropdown_item, servicesName);
                    services.setAdapter(adapter1);
                }else{
                    Toast.makeText(ReservationActivity.this, "No Internet Connection", Toast.LENGTH_SHORT).show();
                }
            }
        });


        ArrayAdapter<String> adapter = new ArrayAdapter<>(this, android.R.layout.simple_spinner_dropdown_item, reservationTime);
        time.setAdapter(adapter);

        btnSubmit.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {

                pd = new ProgressDialog(ReservationActivity.this);
                pd.setMessage("Please wait...");
                pd.show();

                process();

            }
        });
    }

    private void process() {
        Date c = Calendar.getInstance().getTime();
        System.out.println("Current time => " + c);
        Date mToday = new Date();
        SimpleDateFormat sdf = new SimpleDateFormat("hh:mm aa");
        String curTime = sdf.format(mToday);
        try {
            Date yourtime = sdf.parse(curTime);
            Date selectedtime = sdf.parse(time.getSelectedItem().toString());
            Calendar calendar = new GregorianCalendar(dateReservation.getYear(), dateReservation.getMonth()+1, dateReservation.getDayOfMonth());
            if(calendar.get(Calendar.YEAR) < Calendar.getInstance().get(Calendar.YEAR) || calendar.get(Calendar.MONTH) < Calendar.getInstance().get(Calendar.MONTH)+1
                    || calendar.get(Calendar.DAY_OF_MONTH) < Calendar.getInstance().get(Calendar.DAY_OF_MONTH)){
                Toast.makeText(this, "Invalid date", Toast.LENGTH_SHORT).show();
                pd.dismiss();
            }else if(selectedtime.before(yourtime) && calendar.get(Calendar.YEAR) == Calendar.getInstance().get(Calendar.YEAR) && calendar.get(Calendar.MONTH) == Calendar.getInstance().get(Calendar.MONTH)+1
                    && calendar.get(Calendar.DAY_OF_MONTH) == Calendar.getInstance().get(Calendar.DAY_OF_MONTH)){
                Toast.makeText(this, "Invalid time", Toast.LENGTH_SHORT).show();
                pd.dismiss();
            }else{

                ParseQuery<ParseObject> query2 = ParseQuery.getQuery("Reservation");
                query2.whereEqualTo("FBID", CocheApplication.FBID);
                query2.whereEqualTo("CarPlateNumber", CocheApplication.carPlateNumber);
                query2.whereEqualTo("Time", time.getSelectedItem().toString());
                query2.whereEqualTo("Status", "Approved");
                query2.findInBackground(new FindCallback<ParseObject>() {
                    @Override
                    public void done(List<ParseObject> objects, ParseException e) {
                        if(e == null){
                            if(objects.size() == 0){
                                checkpending();

                            }else{
                                Toast.makeText(ReservationActivity.this, "You already have reservation on this time and date", Toast.LENGTH_SHORT).show();
                                pd.dismiss();
                            }

                        }else{
                            checkpending();
                            Toast.makeText(ReservationActivity.this, "No Internet Connection", Toast.LENGTH_SHORT).show();
                        }
                    }
                });

            }

        } catch (java.text.ParseException e) {
            pd.dismiss();
            Toast.makeText(this, ""+e, Toast.LENGTH_SHORT).show();
            e.printStackTrace();
        }




    }

    private void checkpending() {
        ParseQuery<ParseObject> query2 = ParseQuery.getQuery("Reservation");
        query2.whereEqualTo("FBID", CocheApplication.FBID);
        query2.whereEqualTo("CarPlateNumber", CocheApplication.carPlateNumber);
        query2.whereEqualTo("Time", time.getSelectedItem().toString());
        query2.whereEqualTo("Status", "Pending");
        query2.findInBackground(new FindCallback<ParseObject>() {
            @Override
            public void done(List<ParseObject> objects, ParseException e) {
                if(e == null){
                    if(objects.size() == 0){
                        savetodb();
//                        Toast.makeText(ReservationActivity.this, "ok "+time.getSelectedItem().toString()+" "+CocheApplication.carPlateNumber, Toast.LENGTH_SHORT).show();

                    }else{
                        Toast.makeText(ReservationActivity.this, "You already have reservation on this time and date", Toast.LENGTH_SHORT).show();
                        pd.dismiss();
                    }

                }else{
                    //savetodb();
                    Toast.makeText(ReservationActivity.this, "No Internet Connection", Toast.LENGTH_SHORT).show();
                }
            }
        });

    }

    private void savetodb() {
        Date c = Calendar.getInstance().getTime();
        SimpleDateFormat df = new SimpleDateFormat("dd-MMM-yyyy hh:mm aaa");
        String createdAt = df.format(c);
        ParseObject reservation = new ParseObject("Reservation");
        reservation.put("FBID", CocheApplication.FBID);
        reservation.put("Date", dateReservation.getMonth()+1+" "+dateReservation.getDayOfMonth()+" "+dateReservation.getYear());
        reservation.put("Time", time.getSelectedItem().toString());
        reservation.put("ServiceType", CocheApplication.serviceType);
        reservation.put("Service", services.getSelectedItem().toString());
        reservation.put("ObjectID", CocheApplication.companyId);
        reservation.put("CarPlateNumber", CocheApplication.carPlateNumber);
        reservation.put("Amount", "0.00");
        reservation.put("PaymentStatus", "NotPaid");
        reservation.put("Status", "Pending");
        reservation.put("created_at", createdAt);
        reservation.put("updated_at", createdAt);


        reservation.saveInBackground(new SaveCallback() {
            @Override
            public void done(ParseException e) {
                if (e == null){
                    pd.dismiss();
                    CocheApplication.firebaseDatabase = FirebaseDatabase.getInstance();
                    CocheApplication.sendstatus = CocheApplication.firebaseDatabase.getReference("Reservation").child(CocheApplication.companyId);
                    String id = CocheApplication.sendstatus.push().getKey();
                    User user = new User(CocheApplication.FBID);
                    CocheApplication.sendstatus.child(id).setValue(user);
                    Toast.makeText(ReservationActivity.this, "Successfully Reserved. Please wait for your company's approval on your reservation.", Toast.LENGTH_SHORT).show();
                    Intent intent = new Intent();
                    intent.setClass(ReservationActivity.this, MainActivity.class);
                    startActivity(intent);
                }else{
                    pd.dismiss();
                    Toast.makeText(ReservationActivity.this, "No Internet Connection", Toast.LENGTH_SHORT).show();
                }
            }
        });
    }
}
