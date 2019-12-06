package com.coche.usc.activity;

import android.app.ProgressDialog;
import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
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

import androidx.appcompat.app.AlertDialog;
import androidx.appcompat.app.AppCompatActivity;
import androidx.recyclerview.widget.DefaultItemAnimator;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import com.bumptech.glide.Glide;
import com.coche.usc.CocheApplication;
import com.coche.usc.adapter.TransactionAdapter;
import com.facebook.login.LoginManager;
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
import de.hdodenhof.circleimageview.CircleImageView;

public class ProfileActivity extends AppCompatActivity {

    private CircleImageView userPP;
    private TextView name;
    private ImageView btnRepair, btnCarwash, btnTow, btnLogOut, btnAdd;
    private ProgressDialog pd;

    private RecyclerView rvTransactions;
    private RelativeLayout noTransaction;
    private LinearLayout linProfile;

    private TransactionAdapter transactionAdapter;

    private ArrayList<String> carbrand = new ArrayList<>();
    private ArrayList<String> carmodel = new ArrayList<>();

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_profile);

        setupviews();
    }

    private void setupviews() {
        userPP = findViewById(R.id.iv_user_pp);
        name = findViewById(R.id.tv_name);
        btnRepair = findViewById(R.id.btn_repair);
        btnCarwash = findViewById(R.id.btn_carwash);
        btnTow = findViewById(R.id.btn_tow);
        btnLogOut = findViewById(R.id.btn_logout);
        linProfile = findViewById(R.id.lin_profile);
        btnAdd = findViewById(R.id.btn_add);


        btnAdd.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                inflateaddlayout();
            }
        });

        rvTransactions = findViewById(R.id.rv_transactions);
        noTransaction = findViewById(R.id.no_layout);

        linProfile.setBackgroundColor(getResources().getColor(R.color.orange));

        pd = new ProgressDialog(ProfileActivity.this);
        pd.setMessage("Please wait, Retrieving Information");
        pd.show();

        ParseQuery<ParseObject> query1 = ParseQuery.getQuery("Reservation");
        query1.whereEqualTo("FBID", CocheApplication.FBID);
        query1.findInBackground(new FindCallback<ParseObject>() {
            @Override
            public void done(List<ParseObject> objects, ParseException e) {
                if(e == null){
                    noTransaction.setVisibility(View.GONE);
                    rvTransactions.setVisibility(View.VISIBLE);
                    transactionAdapter = new TransactionAdapter(ProfileActivity.this, objects);
                    RecyclerView.LayoutManager mLayoutManager = new LinearLayoutManager(ProfileActivity.this, LinearLayoutManager.VERTICAL, false);
                    rvTransactions.setLayoutManager(mLayoutManager);
                    rvTransactions.setItemAnimator(new DefaultItemAnimator());
                    rvTransactions.setAdapter(transactionAdapter);
                }else{
                    Toast.makeText(ProfileActivity.this, "No Internet Connection or No transactions", Toast.LENGTH_SHORT).show();

                }
            }
        });


        ParseQuery<ParseObject> query = ParseQuery.getQuery("Users");
        query.whereEqualTo("FBID", CocheApplication.FBID);
        query.getFirstInBackground(new GetCallback<ParseObject>() {
            @Override
            public void done(ParseObject object, ParseException e) {
                if (e == null) {
                    Glide.with(ProfileActivity.this).load(object.getString("Picture")).into(userPP);
                    name.setText(""+object.getString("FirstName")+" "+object.getString("LastName"));
                    pd.dismiss();
                }else{
                    Toast.makeText(ProfileActivity.this, "No Internet Connection", Toast.LENGTH_SHORT).show();
                    pd.dismiss();
                }
            }
        });


        btnLogOut.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                SharedPreferences settings = getSharedPreferences(CocheApplication.MY_PREFS_NAME, Context.MODE_PRIVATE);
                settings.edit().clear().commit();
                LoginManager.getInstance().logOut();
                Intent intent = new Intent();
                intent.setClass(ProfileActivity.this, SplashActivity.class);
                startActivity(intent);
                finish();
                overridePendingTransition(R.anim.slide_in_right, R.anim.slide_out_left);
            }
        });
    }

    public void intentrepair(View v){
        Intent intent = new Intent(ProfileActivity.this, MainActivity.class);
        intent.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK | Intent.FLAG_ACTIVITY_CLEAR_TASK);
        startActivity(intent);
        finish();
        overridePendingTransition(R.anim.slide_in_right, R.anim.slide_out_left);
    }

    public void intentcarwash(View v){
        Intent intent = new Intent(ProfileActivity.this, CarwashActivity.class);
        intent.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK | Intent.FLAG_ACTIVITY_CLEAR_TASK);
        startActivity(intent);
        finish();
        overridePendingTransition(R.anim.slide_in_right, R.anim.slide_out_left);
    }

    public void intenttow(View v){
        Intent intent = new Intent(ProfileActivity.this, TowActivity.class);
        intent.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK | Intent.FLAG_ACTIVITY_CLEAR_TASK);
        startActivity(intent);
        finish();
        overridePendingTransition(R.anim.slide_in_right, R.anim.slide_out_left);
    }


    private void inflateaddlayout() {
        LayoutInflater factory = LayoutInflater.from(this);
        final View dialog = factory.inflate(R.layout.dialog_addcar, null);
        final AlertDialog dialoglayout = new AlertDialog.Builder(this, R.style.MyDialogTheme).create();
        dialoglayout.setView(dialog);

        final Spinner carBrand = dialog.findViewById(R.id.spiner_car_brand);
        final Spinner carModel = dialog.findViewById(R.id.spiner_car_model);
        final EditText carPlateNumber = dialog.findViewById(R.id.edit_plate_number);
        Button btnSubmit = dialog.findViewById(R.id.btn_submit);

        carbrand.add("Select Car Brand");
        carbrand.add("Mitsubishi");

        carmodel.add("Select Car Model");
        carmodel.add("Montero");
        carmodel.add("Mirage G4");

        ArrayAdapter<String> adapter = new ArrayAdapter<>(this, android.R.layout.simple_spinner_dropdown_item, carbrand);
        carBrand.setAdapter(adapter);

        ArrayAdapter<String> adapter1 = new ArrayAdapter<>(this, android.R.layout.simple_spinner_dropdown_item, carmodel);
        carModel.setAdapter(adapter1);


        btnSubmit.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                if(carBrand.getSelectedItemPosition() == 0 || carModel.getSelectedItemPosition() == 0){
                    Toast.makeText(ProfileActivity.this, "Please  select car model and car brand", Toast.LENGTH_SHORT).show();
                }else{
                    if(carPlateNumber.getText().toString().compareToIgnoreCase("")==0){
                        Toast.makeText(ProfileActivity.this, "Please input plate number", Toast.LENGTH_SHORT).show();
                    }else{
                        pd = new ProgressDialog(ProfileActivity.this);
                        pd.setMessage("Please wait, Saving Information...");
                        pd.show();

                        Date c = Calendar.getInstance().getTime();
                        System.out.println("Current time => " + c);

                        SimpleDateFormat df = new SimpleDateFormat("dd-MMM-yyyy hh:mm aaa");
                        final String createdAt = df.format(c);

                        ParseObject car = new ParseObject("Car");
                        car.put("CarBrand", carBrand.getSelectedItem().toString());
                        car.put("CarModel", carModel.getSelectedItem().toString());
                        car.put("CarPlateNumber", carPlateNumber.getText().toString());
                        car.put("ObjectID", CocheApplication.FBID);
                        car.put("created_at", createdAt);
                        car.put("updated_at", createdAt);
                        car.saveInBackground(new SaveCallback() {
                            @Override
                            public void done(ParseException e) {
                                pd.dismiss();
                                Toast.makeText(ProfileActivity.this, "Added Successfully", Toast.LENGTH_SHORT).show();
                                dialoglayout.dismiss();
                            }
                        });
                    }
                }
            }
        });

        dialoglayout.show();
    }
}
