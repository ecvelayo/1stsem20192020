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

import androidx.annotation.NonNull;
import androidx.appcompat.app.AlertDialog;
import androidx.recyclerview.widget.DefaultItemAnimator;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import com.bumptech.glide.Glide;

import usc.cochepartner.CochePartnerApplication;
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

public class ApprovedAdapter extends RecyclerView.Adapter<ApprovedAdapter.ApprovedHolder>  {

    private List<ParseObject> objects;
    private Context mContext;
    private RecyclerView rvBooking;
    private String number;


    public ApprovedAdapter(Context context, List<ParseObject> objects, RecyclerView rvBooking) {
        this.objects = objects;
        this.mContext = context;
        this.rvBooking = rvBooking;
    }

    @NonNull
    @Override
    public ApprovedHolder onCreateViewHolder( ViewGroup parent, int viewType) {
        View itemView = LayoutInflater.from(parent.getContext())
                .inflate(R.layout.item_booking_1, parent, false);

        return new ApprovedAdapter.ApprovedHolder(itemView);
    }

    @Override
    public void onBindViewHolder(final ApprovedHolder holder, final int position) {

        holder.services.setText(objects.get(position).getString("Service"));
        holder.time.setText(objects.get(position).getString("Time")+" "+objects.get(position).getString("Date"));

        if(objects.get(position).getString("PaymentStatus").compareToIgnoreCase("NotPaid")==0){
            holder.btnFinish.setVisibility(View.GONE);
        }else{
            holder.btnFinish.setVisibility(View.VISIBLE);
        }

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
                    try{
                        holder.name.setText(objects.getString("FirstName")+" "+objects.getString("LastName"));
                        Glide.with(mContext).load(objects.getString("Picture")).into(holder.profile);
                        String phonenumber = objects.getString("Mobile").substring(1);
                        number = "+63"+phonenumber;
                    }catch (Exception ep){
                        Log.i("Error", ""+ep);
                    }

                }else{
                    Toast.makeText(mContext, "No internet connection", Toast.LENGTH_SHORT).show();
                }
            }
        });

        holder.btnFinish.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {

                Date c = Calendar.getInstance().getTime();
                System.out.println("Current time => " + c);

                SimpleDateFormat df = new SimpleDateFormat("dd-MMM-yyyy hh:mm aaa");
                final String updatedAt = df.format(c);

                ParseQuery<ParseObject> query = ParseQuery.getQuery("Reservation");
                query.whereEqualTo("FBID", objects.get(position).getString("FBID"));
                query.whereEqualTo("Status", "Approved");
                query.whereEqualTo("ServiceType", CochePartnerApplication.Services);
                query.whereEqualTo("PaymentStatus", "Paid");
                query.getFirstInBackground(new GetCallback<ParseObject>() {
                    @Override
                    public void done(ParseObject object, ParseException e) {
                        if(e == null){
                            ParseQuery<ParseObject> query1 = ParseQuery.getQuery("Users");
                            query1.whereEqualTo("FBID", object.getString("FBID"));
                            query1.getFirstInBackground(new GetCallback<ParseObject>() {
                                @Override
                                public void done(ParseObject object1, ParseException e) {
                                    object1.put("PenaltyStatus", "0");
                                    object1.saveInBackground();
                                }
                            });
                            String messageToSend = "Hi, this is "+CochePartnerApplication.companyName+". Thank for booking with us. Your transaction is already done. Take care and hope to see you soon.";
                            SmsManager.getDefault().sendTextMessage(number, null, messageToSend, null,null);
                            object.put("Status", "Completed");
                            object.put("updated_at", updatedAt);
                            object.saveInBackground(new SaveCallback() {
                                @Override
                                public void done(ParseException e) {
                                    if(e == null){
                                        referhesadapter();
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


        holder.btnCancel.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {

                Date c = Calendar.getInstance().getTime();
                System.out.println("Current time => " + c);

                SimpleDateFormat df = new SimpleDateFormat("dd-MMM-yyyy hh:mm aaa");
                final String updatedAt = df.format(c);

                ParseQuery<ParseObject> query = ParseQuery.getQuery("Reservation");
                query.whereEqualTo("FBID", objects.get(position).getString("FBID"));
                query.whereEqualTo("Status", "Approved");
                query.whereEqualTo("ServiceType", "Carwash");
                query.getFirstInBackground(new GetCallback<ParseObject>() {
                    @Override
                    public void done(ParseObject object, ParseException e) {
                        if(e == null){
                            ParseQuery<ParseObject> query1 = ParseQuery.getQuery("Users");
                            query1.whereEqualTo("FBID", object.getString("FBID"));
                            query1.getFirstInBackground(new GetCallback<ParseObject>() {
                                @Override
                                public void done(ParseObject object1, ParseException e) {
                                    object1.put("PenaltyStatus", "0");
                                    object1.saveInBackground();
                                }
                            });
                            object.put("Status", "Canceled");
                            object.put("updated_at", updatedAt);
                            object.saveInBackground(new SaveCallback() {
                                @Override
                                public void done(ParseException e) {
                                    if(e == null){
                                        inflatelayout(number);
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

    private void inflatelayout(final String number) {
        LayoutInflater factory = LayoutInflater.from(mContext);
        View dialog = factory.inflate(R.layout.sms_layout, null);
        final AlertDialog dialoglayout = new AlertDialog.Builder(mContext, R.style.MyDialogTheme).create();
        dialoglayout.setView(dialog);

        Button btnProceed = dialog.findViewById(R.id.btn_proceed);
        final EditText editReason = dialog.findViewById(R.id.edit_reason);

        btnProceed.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                String messageToSend = "Hi, this is "+CochePartnerApplication.companyName+". We are very sorry that we have declined your reservation due to " +
                        editReason.getText().toString()+". We have refunded your payment for reservation";
                SmsManager.getDefault().sendTextMessage(number, null, messageToSend, null,null);
                referhesadapter();
                dialoglayout.dismiss();
            }
        });

        dialoglayout.show();
    }

    private void referhesadapter() {
        ParseQuery<ParseObject> query = ParseQuery.getQuery("Reservation");
        query.whereEqualTo("ObjectID", CochePartnerApplication.objectID);
        query.whereEqualTo("Status", "Approved");
        query.findInBackground(new FindCallback<ParseObject>() {
            @Override
            public void done(List<ParseObject> objects, ParseException e) {
                if(e == null){
//                    for (int j = 0; j < objects.size(); j++)
//                    {
//                        ParseObject parseObject = objects.get(j);
//                        //fetching data from parseObject
//                    }
                   // Toast.makeText(mContext, ""+objects.size(), Toast.LENGTH_SHORT).show();
                    ApprovedAdapter approvedAdapter = new ApprovedAdapter(mContext, objects, rvBooking);
                    RecyclerView.LayoutManager mLayoutManager = new LinearLayoutManager(mContext, LinearLayoutManager.VERTICAL, false);
                    rvBooking.setLayoutManager(mLayoutManager);
                    rvBooking.setItemAnimator(new DefaultItemAnimator());
                    rvBooking.setAdapter(approvedAdapter);
                    notifyDataSetChanged();

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

    public class ApprovedHolder extends RecyclerView.ViewHolder {

        private CircleImageView profile;
        private TextView name, services, car, platenumber, time;
        private Button btnCancel, btnFinish;


        public ApprovedHolder(View view) {
            super(view);

            profile = view.findViewById(R.id.image);
            name = view.findViewById(R.id.name);
            services = view.findViewById(R.id.services);
            car = view.findViewById(R.id.car);
            time = view.findViewById(R.id.time);
            btnFinish = view.findViewById(R.id.btn_accept);
            platenumber = view.findViewById(R.id.car_number);
            btnCancel = view.findViewById(R.id.btn_decline);

        }
    }


}
