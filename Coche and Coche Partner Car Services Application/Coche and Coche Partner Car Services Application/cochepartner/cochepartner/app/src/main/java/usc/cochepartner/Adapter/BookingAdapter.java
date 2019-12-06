package usc.cochepartner.Adapter;

import android.content.Context;
import android.telephony.SmsManager;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

import androidx.appcompat.app.AlertDialog;
import androidx.recyclerview.widget.DefaultItemAnimator;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import com.bumptech.glide.Glide;
import usc.cochepartner.CochePartnerApplication;

import com.google.firebase.database.DataSnapshot;
import com.google.firebase.database.DatabaseError;
import com.google.firebase.database.FirebaseDatabase;
import com.google.firebase.database.ValueEventListener;
import com.parse.FindCallback;
import com.parse.GetCallback;
import com.parse.ParseException;
import com.parse.ParseObject;
import com.parse.ParseQuery;
import com.parse.SaveCallback;
import com.usc.cochepartner.R;

import java.text.SimpleDateFormat;
import java.util.Calendar;
import java.util.Date;
import java.util.List;

import de.hdodenhof.circleimageview.CircleImageView;

public class BookingAdapter extends RecyclerView.Adapter<BookingAdapter.BookingHolder> {

    private List<ParseObject> objects;
    private Context mContext;
    private RecyclerView rvBooking;
    private String number;


    public BookingAdapter(Context context, List<ParseObject> objects, RecyclerView rvBooking) {
        this.objects = objects;
        this.mContext = context;
        this.rvBooking = rvBooking;
    }

    @Override
    public BookingHolder onCreateViewHolder( ViewGroup parent, int viewType) {
        View itemView = LayoutInflater.from(parent.getContext())
                .inflate(R.layout.item_booking, parent, false);

        return new BookingHolder(itemView);
    }

    @Override
    public void onBindViewHolder(final BookingHolder holder, final int position) {

        holder.services.setText(objects.get(position).getString("Service"));
        holder.time.setText(objects.get(position).getString("Time")+" "+objects.get(position).getString("Date"));

        ParseQuery<ParseObject> query2 = ParseQuery.getQuery("Car");
        query2.whereEqualTo("CarPlateNumber", objects.get(position).getString("CarPlateNumber"));
        //query.whereEqualTo("Password", password.getText().toString());
        query2.getFirstInBackground(new GetCallback<ParseObject>() {
            @Override
            public void done(ParseObject objects, ParseException e) {
                if(e == null){
                    holder.car.setText(objects.getString("CarModel"));
                    holder.platenumber.setText(objects.getString("CarPlateNumber"));
                }else{
                    Toast.makeText(mContext, "No internet connection", Toast.LENGTH_SHORT).show();
                }
            }
        });

        ParseQuery<ParseObject> query = ParseQuery.getQuery("Users");
        query.whereEqualTo("FBID", objects.get(position).getString("FBID"));
        //query.whereEqualTo("Password", password.getText().toString());
        query.getFirstInBackground(new GetCallback<ParseObject>() {
            @Override
            public void done(ParseObject objects, ParseException e) {
                if(e == null){
                    holder.name.setText(objects.getString("FirstName")+" "+objects.getString("LastName"));
                    String phonenumber = objects.getString("Mobile").substring(1);
                    number = "+63"+phonenumber;
                    Glide.with(mContext).load(objects.getString("Picture")).into(holder.profile);
                }else{
                    Toast.makeText(mContext, "No internet connection", Toast.LENGTH_SHORT).show();
                }
            }
        });



        holder.btnDecline.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {

                Date c = Calendar.getInstance().getTime();
                System.out.println("Current time => " + c);

                SimpleDateFormat df = new SimpleDateFormat("dd-MMM-yyyy hh:mm aaa");
                final String updatedAt = df.format(c);

                ParseQuery<ParseObject> query = ParseQuery.getQuery("Reservation");
                query.whereEqualTo("FBID", objects.get(position).getString("FBID"));
                query.whereEqualTo("Status", "Pending");
                query.getFirstInBackground(new GetCallback<ParseObject>() {
                    @Override
                    public void done(ParseObject object, ParseException e) {
                        if(e == null){
                            deletefb(object.getString("FBID"));
                            object.put("Status", "Declined");
                            object.put("updated_at", updatedAt);

                            object.saveInBackground(new SaveCallback() {
                                @Override
                                public void done(ParseException e) {
                                    if(e == null){
                                        inflatesmslayout(number);
                                    }else{
                                        Toast.makeText(mContext, "No Internet Connection", Toast.LENGTH_SHORT).show();
                                    }
                                }
                            });
                        }else{
                            Toast.makeText(mContext, "No Internet Connection", Toast.LENGTH_SHORT).show();
                        }
                    }
                });
            }
        });

        holder.btnapproved.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Date c = Calendar.getInstance().getTime();
                System.out.println("Current time => " + c);

                SimpleDateFormat df = new SimpleDateFormat("dd-MMM-yyyy hh:mm aaa");
                final String updatedAt = df.format(c);

                ParseQuery<ParseObject> query = ParseQuery.getQuery("Reservation");
                query.whereEqualTo("FBID", objects.get(position).getString("FBID"));
                query.whereEqualTo("Status", "Pending");
                query.whereEqualTo("ServiceType",    CochePartnerApplication.Services);
                query.getFirstInBackground(new GetCallback<ParseObject>() {
                    @Override
                    public void done(ParseObject object, ParseException e) {
                        if(e == null){
                            String messageToSend = "Hi, this is "+CochePartnerApplication.companyName+". Thank for booking with us. We have accepted your " +
                                    "reservation. Please be reminded that you need to pay for your reservation.";
                            SmsManager.getDefault().sendTextMessage(number, null, messageToSend, null,null);
                            deletefb(object.getString("FBID"));
                            object.put("Status", "Approved");
                            object.put("updated_at", updatedAt);
                            object.saveInBackground(new SaveCallback() {
                                @Override
                                public void done(ParseException e) {
                                    if(e == null){
                                        refreshadapter();
                                    }else{
                                        Toast.makeText(mContext, "No Internet Connection", Toast.LENGTH_SHORT).show();
                                    }
                                }
                            });
                        }else{
                            Toast.makeText(mContext, "No Internet Connection", Toast.LENGTH_SHORT).show();
                        }
                    }
                });
            }
        });

    }

    private void deletefb(final String fbid) {
        CochePartnerApplication.firebaseDatabase = FirebaseDatabase.getInstance();
        CochePartnerApplication.sendstatus = CochePartnerApplication.firebaseDatabase.getReference("Reservation").child(CochePartnerApplication.objectID);
        CochePartnerApplication.sendstatus.addValueEventListener(new ValueEventListener() {
            @Override
            public void onDataChange(DataSnapshot dataSnapshot) {
                for (DataSnapshot childkey : dataSnapshot.getChildren()) {
                    String key = childkey.getKey();
                    //Toast.makeText(MainActivity.this, ""+childkey.child("FBUSER").getValue()+" "+key, Toast.LENGTH_SHORT).show();
                    if(childkey.child("FBUSER").getValue().toString().compareTo(fbid)==0){
                        childkey.getRef().removeValue();
                    }
                }

            }
            @Override
            public void onCancelled(DatabaseError databaseError) {
                Log.e("Database: ", ""+databaseError.getMessage());
                Toast.makeText(mContext, ""+databaseError.getMessage(), Toast.LENGTH_SHORT).show();
            }
        });
    }

    private void inflatesmslayout(final String number) {
        LayoutInflater factory = LayoutInflater.from(mContext);
        View dialog = factory.inflate(R.layout.sms_layout, null);
        final AlertDialog dialoglayout = new AlertDialog.Builder(mContext, R.style.MyDialogTheme).create();
        dialoglayout.setView(dialog);

        Button btnProceed = dialog.findViewById(R.id.btn_proceed);
        final EditText editReason = dialog.findViewById(R.id.edit_reason);

        btnProceed.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                String messageToSend = "Hi, this is "+CochePartnerApplication.companyName+". Thank for booking with us. We are very sorry that we have declined your reservation due to" +
                      editReason.getText().toString();
                SmsManager.getDefault().sendTextMessage(number, null, messageToSend, null,null);
                refreshadapter();
                dialoglayout.dismiss();
            }
        });

        dialoglayout.show();
    }

    private void refreshadapter() {
        ParseQuery<ParseObject> query = ParseQuery.getQuery("Reservation");
        query.whereEqualTo("ObjectID", CochePartnerApplication.objectID);
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
                    BookingAdapter bookingAdapter = new BookingAdapter(mContext, objects, rvBooking);
                    RecyclerView.LayoutManager mLayoutManager = new LinearLayoutManager(mContext, LinearLayoutManager.VERTICAL, false);
                    rvBooking.setLayoutManager(mLayoutManager);
                    rvBooking.setItemAnimator(new DefaultItemAnimator());
                    rvBooking.setAdapter(bookingAdapter);
                }else{
                    Toast.makeText(mContext, ""+e, Toast.LENGTH_SHORT).show();
                }
            }
        });
    }

    @Override
    public int getItemCount() {
        return objects.size();
    }

    public class BookingHolder extends RecyclerView.ViewHolder {

        private CircleImageView profile;
        private TextView name, services, car, platenumber, time;
        private Button btnapproved, btnDecline;


        public BookingHolder(View view) {
            super(view);

            profile = view.findViewById(R.id.image);
            name = view.findViewById(R.id.name);
            services = view.findViewById(R.id.services);
            car = view.findViewById(R.id.car);
            time = view.findViewById(R.id.time);
            platenumber = view.findViewById(R.id.car_number);
            btnapproved = view.findViewById(R.id.btn_accept);
            btnDecline = view.findViewById(R.id.btn_decline);
        }
    }
}
