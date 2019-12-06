package usc.cochepartner;

import androidx.annotation.Nullable;
import androidx.appcompat.app.AppCompatActivity;

import android.app.ProgressDialog;
import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.EditText;
import android.widget.FrameLayout;
import android.widget.Spinner;
import android.widget.TextView;
import android.widget.Toast;

import com.google.android.libraries.places.api.Places;
import com.google.android.libraries.places.api.model.Place;
import com.google.android.libraries.places.widget.Autocomplete;
import com.google.android.libraries.places.widget.model.AutocompleteActivityMode;
import com.parse.GetCallback;
import com.parse.Parse;
import com.parse.ParseException;
import com.parse.ParseGeoPoint;
import com.parse.ParseObject;
import com.parse.ParseQuery;
import com.parse.SaveCallback;
import com.usc.cochepartner.R;

import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Arrays;
import java.util.Calendar;
import java.util.Date;
import java.util.GregorianCalendar;
import java.util.List;

public class RegisterActivity extends AppCompatActivity {

    private EditText companyName, firstName, lastName, userName, password, email, number;
    private FrameLayout address;
    private TextView tvAddress;
    private Spinner services, monday, tuesday, wednesday, thursday, friday, saturday, sunday, openingTime, closingTime;
    private Button submit;

    private  ProgressDialog pd;

    private ArrayList<String> service = new ArrayList<>();
    private ArrayList<String> statusM = new ArrayList<>();
    private ArrayList<String> statusT = new ArrayList<>();
    private ArrayList<String> statusW = new ArrayList<>();
    private ArrayList<String> statusTH = new ArrayList<>();
    private ArrayList<String> statusF = new ArrayList<>();
    private ArrayList<String> statusS = new ArrayList<>();
    private ArrayList<String> statusSun = new ArrayList<>();
    private ArrayList<String> openingT = new ArrayList<>();
    private ArrayList<String> closingT = new ArrayList<>();

    private Double lat, lng;
    private ParseGeoPoint location;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_register);

        Parse.initialize(new Parse.Configuration.Builder(this)
                .applicationId(getString(R.string.back4app_app_id))
                // if defined
                .clientKey(getString(R.string.back4app_client_key))
                .server(getString(R.string.back4app_server_url))
                .build()
        );

        if(!Places.isInitialized()){
            Places.initialize(this, getString(R.string.API));
            //mGeoDataClient = com.google.android.gms.location.places.Places.getGeoDataClient(this, null);
        }else{
            //mGeoDataClient = com.google.android.gms.location.places.Places.getGeoDataClient(this, null);
        }

        setupviews();
    }

    @Override
    protected void onActivityResult(int requestCode, int resultCode, @Nullable Intent data) {
        super.onActivityResult(requestCode, resultCode, data);
        if (requestCode == 1) {
            if (resultCode == RESULT_OK) {
                Place place = Autocomplete.getPlaceFromIntent(data);
                tvAddress.setText(""+place.getName());
//                lat = place.getLatLng().latitude;
//                lng = place.getLatLng().longitude;
                location = new ParseGeoPoint(place.getLatLng().latitude, place.getLatLng().longitude);
//                HubSpaApplication.address = searchValue.getText().toString();
//                LatLng newlocation = new LatLng();
//                newlocation.setLatitude(place.getLatLng().latitude);
//                newlocation.setLongitude(place.getLatLng().longitude);
//                updatelocation(newlocation);
            }else{
                Log.i("Place: ", ""+resultCode);
            }

        }else{
            Log.i("Place: ", ""+requestCode);
        }

    }

    private void setupviews() {
        companyName = findViewById(R.id.edit_companyName);
        firstName = findViewById(R.id.edit_firstName);
        lastName = findViewById(R.id.edit_LastName);
        address = findViewById(R.id.search_frame1);
        services = findViewById(R.id.spiiner_services);
        submit = findViewById(R.id.btn_submit);
        password = findViewById(R.id.edit_password);
        userName = findViewById(R.id.edit_userName);
        email = findViewById(R.id.edit_email);
        number = findViewById(R.id.edit_number);
        monday = findViewById(R.id.spinner_monday);
        tuesday = findViewById(R.id.spinner_tuesday);
        wednesday = findViewById(R.id.spinner_wednesday);
        thursday = findViewById(R.id.spinner_thursday);
        friday = findViewById(R.id.spinner_friday);
        saturday = findViewById(R.id.spinner_saturday);
        sunday = findViewById(R.id.spinner_sunday);
        tvAddress = findViewById(R.id.main_search_value);
//        openingTime = findViewById(R.id.spiiner_opening_time);
//        closingTime = findViewById(R.id.spinner_closing_time);

//        tvAddress.setText("Talamban");
//
//        location = new ParseGeoPoint(10.354268, 123.911625);

        service.add("Select type of service");
        service.add("Towing");
        service.add("Carwash");
        service.add("Repair");

        statusM.add("Choose your status of your store on Monday");
        statusM.add("Open");
        statusM.add("Closed");

        statusT.add("Choose your status of your store on Tuesday");
        statusT.add("Open");
        statusT.add("Closed");

        statusW.add("Choose your status of your store on Wednesday");
        statusW.add("Open");
        statusW.add("Closed");

        statusTH.add("Choose your status of your store on Thursday");
        statusTH.add("Open");
        statusTH.add("Closed");

        statusF.add("Choose your status of your store on Friday");
        statusF.add("Open");
        statusF.add("Closed");

        statusS.add("Choose your status of your store on Saturday");
        statusS.add("Open");
        statusS.add("Closed");

        statusSun.add("Choose your status of your store on Sunday");
        statusSun.add("Open");
        statusSun.add("Closed");

        ArrayAdapter<String> adapter = new ArrayAdapter<>(this, android.R.layout.simple_spinner_dropdown_item, service);
        services.setAdapter(adapter);
        ArrayAdapter<String> mon = new ArrayAdapter<>(this, android.R.layout.simple_spinner_dropdown_item, statusM);
        monday.setAdapter(mon);
        ArrayAdapter<String> tue = new ArrayAdapter<>(this, android.R.layout.simple_spinner_dropdown_item, statusT);
        tuesday.setAdapter(tue);
        ArrayAdapter<String> wed = new ArrayAdapter<>(this, android.R.layout.simple_spinner_dropdown_item, statusW);
        wednesday.setAdapter(wed);
        ArrayAdapter<String> thur = new ArrayAdapter<>(this, android.R.layout.simple_spinner_dropdown_item, statusTH);
        thursday.setAdapter(thur);
        ArrayAdapter<String> fri = new ArrayAdapter<>(this, android.R.layout.simple_spinner_dropdown_item, statusF);
        friday.setAdapter(fri);
        ArrayAdapter<String> sat = new ArrayAdapter<>(this, android.R.layout.simple_spinner_dropdown_item, statusS);
        saturday.setAdapter(sat);
        ArrayAdapter<String> sun = new ArrayAdapter<>(this, android.R.layout.simple_spinner_dropdown_item, statusSun);
        sunday.setAdapter(sun);

        address.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                List<Place.Field> fields = Arrays.asList(Place.Field.ID, Place.Field.NAME, Place.Field.LAT_LNG);

                Intent intent = new Autocomplete.IntentBuilder(
                        AutocompleteActivityMode.OVERLAY, fields)
                        //.setLocationRestriction(bounds)
                        //.setLocationRestriction(bounds_1)
                        //.setLocationBias()
                        .setCountry("PH")
                        //.setTypeFilter(TypeFilter.ADDRESS)
                        .build(RegisterActivity.this);
                startActivityForResult(intent, 1);

            }
        });



        services.setOnItemSelectedListener(new AdapterView.OnItemSelectedListener() {
            @Override
            public void onItemSelected(AdapterView<?> adapterView, View view, int i, long l) {
                if(services.getSelectedItem().toString().compareToIgnoreCase("Carwash")==0){
                    monday.setVisibility(View.VISIBLE);
                    tuesday.setVisibility(View.VISIBLE);
                    wednesday.setVisibility(View.VISIBLE);
                    thursday.setVisibility(View.VISIBLE);
                    friday.setVisibility(View.VISIBLE);
                    saturday.setVisibility(View.VISIBLE);
                    sunday.setVisibility(View.VISIBLE);
//                    openingTime.setVisibility(View.VISIBLE);
//                    closingTime.setVisibility(View.VISIBLE);
                }else{
                    monday.setVisibility(View.GONE);
                    tuesday.setVisibility(View.GONE);
                    wednesday.setVisibility(View.GONE);
                    thursday.setVisibility(View.GONE);
                    friday.setVisibility(View.GONE);
                    saturday.setVisibility(View.GONE);
                    sunday.setVisibility(View.GONE);
//                    openingTime.setVisibility(View.GONE);
//                    closingTime.setVisibility(View.GONE);
                }
            }

            @Override
            public void onNothingSelected(AdapterView<?> adapterView) {

            }
        });

        submit.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                pd = new ProgressDialog(RegisterActivity.this);
                pd.setMessage("Please wait...");
                pd.show();

                String cName = companyName.getText().toString();
                String fName= firstName.getText().toString();
                String lName = lastName.getText().toString();
                String eAdd = email.getText().toString();
                String mNumber = number.getText().toString();
                String tAddress = tvAddress.getText().toString();
                String uName = userName.getText().toString();
                String pWord = password.getText().toString();
                int cService = services.getSelectedItemPosition();

                if(cName.compareToIgnoreCase("")==0 || fName.compareToIgnoreCase("")==0 || lName.compareToIgnoreCase("")==0 || eAdd.compareToIgnoreCase("")==0
                || mNumber.compareToIgnoreCase("")==0 || tAddress.compareToIgnoreCase("")==0 || uName.compareToIgnoreCase("")==0 || pWord.compareToIgnoreCase("")==0){
                    Toast.makeText(RegisterActivity.this, "Please fill up the missing fields", Toast.LENGTH_SHORT).show();
                    pd.dismiss();
                }else{
                    if (password.getText().toString().length() < 6){
                        Toast.makeText(RegisterActivity.this, "Password must be atleast 6 characters/numbers", Toast.LENGTH_SHORT).show();
                    }else{
                        if(cService == 0){
                            Toast.makeText(RegisterActivity.this, "Please select Service", Toast.LENGTH_SHORT).show();
                            pd.dismiss();
                        }else if(cService == 2){
                            if(monday.getSelectedItemPosition() == 0 || tuesday.getSelectedItemPosition() == 0 || wednesday.getSelectedItemPosition() == 0 || thursday.getSelectedItemPosition() == 0
                                    || friday.getSelectedItemPosition() == 0 || saturday.getSelectedItemPosition() == 0 || sunday.getSelectedItemPosition() == 0){
                                Toast.makeText(RegisterActivity.this, "Please select status (open/close)", Toast.LENGTH_SHORT).show();
                                pd.dismiss();
                            }else{
                                process();
                            }
                        }else{
                            process();
                        }
                    }

                }

            }
        });

    }

    private void process() {
        Date c = Calendar.getInstance().getTime();
        System.out.println("Current time => " + c);

        SimpleDateFormat df = new SimpleDateFormat("dd-MMM-yyyy hh:mm aaa");
        final String createdAt = df.format(c);

        ParseQuery<ParseObject> query = ParseQuery.getQuery("Partner");
        query.whereEqualTo("UserName", userName.getText().toString());
        query.getFirstInBackground(new GetCallback<ParseObject>() {
            @Override
            public void done(ParseObject object, ParseException e) {
                if(e == null){
                    Toast.makeText(RegisterActivity.this, "Fields must not be empty", Toast.LENGTH_SHORT).show();
                    pd.dismiss();
                }else{

                    ParseObject partner = new ParseObject("Partner");
                    partner.put("CompanyName", companyName.getText().toString());
                    partner.put("FirstName", firstName.getText().toString());
                    partner.put("LastName", lastName.getText().toString());
                    partner.put("Address", tvAddress.getText().toString());
                    partner.put("Services", services.getSelectedItem().toString());
                    partner.put("UserName", userName.getText().toString());
                    partner.put("Password", password.getText().toString());
                    partner.put("Email", email.getText().toString());
                    partner.put("Number", number.getText().toString());
                    partner.put("Location", location);
                    partner.put("Monday", monday.getSelectedItem().toString());
                    partner.put("Tuesday", tuesday.getSelectedItem().toString());
                    partner.put("Wednesday", wednesday.getSelectedItem().toString());
                    partner.put("Thursday", thursday.getSelectedItem().toString());
                    partner.put("Friday", friday.getSelectedItem().toString());
                    partner.put("Saturday", saturday.getSelectedItem().toString());
                    partner.put("Sunday", sunday.getSelectedItem().toString());
                    partner.put("Status", 0);
                    partner.put("created_at", createdAt);
                    partner.put("updated_at", createdAt);
//                partner.put("OpeningTime", openingTime.getSelectedItem().toString());
//                partner.put("ClosingTime", closingTime.getSelectedItem().toString());

                    partner.saveInBackground(new SaveCallback() {
                        @Override
                        public void done(ParseException e) {
                            if (e == null){
                                pd.dismiss();
                                Toast.makeText(RegisterActivity.this, "Successfully Registered", Toast.LENGTH_SHORT).show();
                                Intent intent = new Intent();
                                intent.setClass(RegisterActivity.this, SplashActivity.class);
                                startActivity(intent);
                            }else{
                                Toast.makeText(RegisterActivity.this, "No Internet Connection", Toast.LENGTH_SHORT).show();
                            }
                        }
                    });


                }
            }
        });

    }
}
