package com.gsb.ppe.geolocalisation;

import android.Manifest;
import android.content.Context;
import android.content.pm.PackageManager;
import android.location.Location;
import android.support.v4.content.ContextCompat;
import android.telephony.TelephonyManager;
import android.util.Log;

import com.loopj.android.http.AsyncHttpClient;
import com.loopj.android.http.AsyncHttpResponseHandler;
import com.loopj.android.http.RequestParams;
import cz.msebera.android.httpclient.Header;

public class Utils {
    public static void sendLocation(Context context, Location location) {
        // http://loopj.com/android-async-http/
        AsyncHttpClient client = new AsyncHttpClient();

        client.setTimeout(5000);

        RequestParams params = new RequestParams();
        params.put("imei", Utils.getIMEI(context));
        params.put("longitude", String.valueOf(location.getLongitude()));
        params.put("latitude", String.valueOf(location.getLatitude()));

        client.post(Config.getAPI_URL() + Config.getAPI_ADD_LOCATION(), params, new AsyncHttpResponseHandler() {
            @Override
            public void onSuccess(int statusCode, Header[] headers, byte[] responseBody) {
                Log.d("Utils", "Position sent");
            }

            @Override
            public void onFailure(int statusCode, Header[] headers, byte[] responseBody, Throwable error) {
                Log.e("Error Utils", error.getMessage());
            }
        });

        Log.d("pos", params.toString());

    }

    public static String getIMEI(Context context) {
        if(ContextCompat.checkSelfPermission(context, Manifest.permission.READ_PHONE_STATE) == PackageManager.PERMISSION_GRANTED) {
            TelephonyManager tMgr = (TelephonyManager) context.getSystemService(context.TELEPHONY_SERVICE);
            String imei = tMgr.getDeviceId();
           return imei;
        } else {
            return null;
        }
    }

}
