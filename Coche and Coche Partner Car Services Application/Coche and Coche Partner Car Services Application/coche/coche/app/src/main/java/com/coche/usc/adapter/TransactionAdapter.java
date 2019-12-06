package com.coche.usc.adapter;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.TextView;
import android.widget.Toast;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import com.coche.usc.CocheApplication;
import com.parse.GetCallback;
import com.parse.ParseException;
import com.parse.ParseObject;
import com.parse.ParseQuery;

import java.util.List;

import co.coche.usc.R;

public class TransactionAdapter extends RecyclerView.Adapter<TransactionAdapter.TransactionHolder>{

    private Context mContext;
    private List<ParseObject> itemlist;

    public TransactionAdapter(Context context, List<ParseObject> itemlist) {
        this.itemlist = itemlist;
        this.mContext = context;
//        this.time_picker = time;
    }

    @NonNull
    @Override
    public TransactionHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View itemView = LayoutInflater.from(parent.getContext())
                .inflate(R.layout.transactions_layout, parent, false);

        return new TransactionAdapter.TransactionHolder(itemView);
    }

    @Override
    public void onBindViewHolder(final TransactionHolder holder, int position) {
        holder.tvDate.setText(itemlist.get(position).getString("created_at"));
        holder.tvStatus.setText(itemlist.get(position).getString("Status"));
        ParseQuery<ParseObject> query = ParseQuery.getQuery("Partner");
        query.whereEqualTo("objectId", itemlist.get(position).getString("ObjectID"));
        query.getFirstInBackground(new GetCallback<ParseObject>() {
            @Override
            public void done(ParseObject object, ParseException e) {
                if(e == null){
                    holder.tvCompanyName.setText(object.getString("CompanyName"));
                    //Toast.makeText(mContext, ""+object.getString("CompanyName"), Toast.LENGTH_SHORT).show();
                    holder.tvServices.setText(object.getString("Services"));
                }else{
                    Toast.makeText(mContext, "No Internet Connection", Toast.LENGTH_SHORT).show();
                }
            }
        });

    }

    @Override
    public int getItemCount() {
        return itemlist.size();
    }

    public class TransactionHolder extends RecyclerView.ViewHolder {

        //private Button btnLocate, btnReserve;
        private TextView tvCompanyName, tvStatus, tvDate, tvServices;

        public TransactionHolder(View view) {
            super(view);

//            btnReserve = view.findViewById(R.id.btn_reserve);
            tvCompanyName = view.findViewById(R.id.txt_company);
            tvStatus = view.findViewById(R.id.txt_status);
            tvDate = view.findViewById(R.id.txt_date);
            tvServices = view.findViewById(R.id.txt_services);
        }
    }
}
