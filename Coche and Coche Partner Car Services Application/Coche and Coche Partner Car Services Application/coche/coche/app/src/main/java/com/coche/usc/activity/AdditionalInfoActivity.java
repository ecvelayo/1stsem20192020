package com.coche.usc.activity;

import androidx.appcompat.app.AppCompatActivity;

import android.app.ProgressDialog;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Spinner;
import android.widget.Toast;

import com.coche.usc.CocheApplication;
import com.parse.Parse;
import com.parse.ParseException;
import com.parse.ParseObject;
import com.parse.SaveCallback;

import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Calendar;
import java.util.Date;

import co.coche.usc.R;

public class AdditionalInfoActivity extends AppCompatActivity {

    private Spinner carBrand, carModel, carCategory;
    private EditText carPlateNumber, mobileNumber;
    private Button btnSubmit;

    private ArrayList<String> carbrand = new ArrayList<>();
    private ArrayList<String> carmodel = new ArrayList<>();
    private ArrayList<String> category = new ArrayList<>();

    private ProgressDialog pd;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_additional_info);

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

        carBrand = findViewById(R.id.spiner_car_brand);
        carModel = findViewById(R.id.spiner_car_model);
        carPlateNumber = findViewById(R.id.edit_plate_number);
        btnSubmit = findViewById(R.id.btn_submit);
        mobileNumber = findViewById(R.id.edit_mobile_number);
        carCategory = findViewById(R.id.spiner_car_category);

        carbrand.add("Select Car Brand");
        carbrand.add("Mitsubishi");

        carmodel.add("Select Car Model");
        carmodel.add("Montero");
        carmodel.add("Mirage G4");

        category.add("Please select car category");
        category.add("4 wheels");
        category.add("2 wheels");

        ArrayAdapter<String> adapter = new ArrayAdapter<>(this, android.R.layout.simple_spinner_dropdown_item, carbrand);
        carBrand.setAdapter(adapter);

        ArrayAdapter<String> adapter1 = new ArrayAdapter<>(this, android.R.layout.simple_spinner_dropdown_item, carmodel);
        carModel.setAdapter(adapter1);

        ArrayAdapter<String> adapter2 = new ArrayAdapter<>(this, android.R.layout.simple_spinner_dropdown_item, category);
        carCategory.setAdapter(adapter2);

        btnSubmit.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {

                if(carPlateNumber.getText().toString().compareToIgnoreCase("")==0 || mobileNumber.getText().toString().compareToIgnoreCase("")==0){
                    Toast.makeText(AdditionalInfoActivity.this, "Please enter Car Plate Number and Mobile Number", Toast.LENGTH_SHORT).show();
                }else{
                    if(carBrand.getSelectedItemPosition() == 0 || carModel.getSelectedItemPosition() == 0 || carCategory.getSelectedItemPosition() == 0){
                        Toast.makeText(AdditionalInfoActivity.this, "Please input carbrand, car model and car category", Toast.LENGTH_SHORT).show();
                    }else{
                        process();
                    }
                }
            }
        });

    }

    private void process() {
        pd = new ProgressDialog(AdditionalInfoActivity.this);
        pd.setMessage("Please wait, Saving Information...");
        pd.show();

        Date c = Calendar.getInstance().getTime();
        System.out.println("Current time => " + c);

        SimpleDateFormat df = new SimpleDateFormat("dd-MMM-yyyy hh:mm aaa");
        final String createdAt = df.format(c);

        final ParseObject user = new ParseObject("Users");
        user.put("FBID", CocheApplication.FBID);
        user.put("FirstName", CocheApplication.firstName);
        user.put("LastName", CocheApplication.lastName);
        user.put("Picture", CocheApplication.picture);
        user.put("Mobile", mobileNumber.getText().toString());
        user.put("PenaltyStatus", "0");
        user.put("created_at", createdAt);
        user.put("updated_at", createdAt);

        user.saveInBackground(new SaveCallback() {
            @Override
            public void done(ParseException e) {
                if (e == null){
                    ParseObject car = new ParseObject("Car");
                    car.put("CarBrand", carBrand.getSelectedItem().toString());
                    car.put("CarModel", carModel.getSelectedItem().toString());
                    car.put("CarPlateNumber", carPlateNumber.getText().toString());
                    car.put("CarCategory", carCategory.getSelectedItem().toString());
                    car.put("ObjectID", CocheApplication.FBID);
                    car.put("created_at", createdAt);
                    car.put("updated_at", createdAt);
                    car.saveInBackground(new SaveCallback() {
                        @Override
                        public void done(ParseException e) {
                            SharedPreferences.Editor editor = getSharedPreferences(CocheApplication.MY_PREFS_NAME, MODE_PRIVATE).edit();
                            editor.putString("fbId", CocheApplication.FBID);
                            editor.apply();
                            pd.dismiss();
                            Toast.makeText(AdditionalInfoActivity.this, "Successfully Registered", Toast.LENGTH_SHORT).show();
                            Intent intent = new Intent();
                            intent.setClass(AdditionalInfoActivity.this, MainActivity.class);
                            startActivity(intent);
                        }
                    });

                }else{
                    Toast.makeText(AdditionalInfoActivity.this, "No Internet Connection", Toast.LENGTH_SHORT).show();
                    pd.dismiss();
                }
            }
        });

    }
}
