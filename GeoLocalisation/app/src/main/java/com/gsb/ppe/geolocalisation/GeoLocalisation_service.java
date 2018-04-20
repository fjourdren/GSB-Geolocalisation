package com.gsb.ppe.geolocalisation;

import android.Manifest;
import android.app.Notification;
import android.app.PendingIntent;
import android.app.Service;
import android.content.Intent;
import android.content.pm.PackageManager;
import android.location.Location;
import android.location.LocationManager;
import android.os.Bundle;
import android.os.IBinder;
import android.support.v4.content.ContextCompat;
import android.telephony.TelephonyManager;
import android.util.Log;
import android.widget.Toast;

public class GeoLocalisation_service extends Service {
    private static final String TAG = "GeoLocalisation_service";
    private LocationManager mLocationManager = null;
    private static final int LOCATION_INTERVAL = Config.getLOCATION_INTERVAL();
    private static final float LOCATION_DISTANCE = Config.getLOCATION_DISTANCE();

    public GeoLocalisation_service() {
    }

    private class LocationListener implements android.location.LocationListener {

        Location mLastLocation;

        public LocationListener(String provider) {
            Log.e(TAG, "LocationListener " + provider);
            mLastLocation = new Location(provider);
        }

        @Override
        public void onLocationChanged(Location location) {
            Log.e(TAG, "onLocationChanged: " + location.toString());
            mLastLocation.set(location);

            if(ContextCompat.checkSelfPermission(getApplicationContext(), Manifest.permission.READ_PHONE_STATE) == PackageManager.PERMISSION_GRANTED) {
                TelephonyManager tMgr = (TelephonyManager) getApplicationContext().getSystemService(getApplicationContext().TELEPHONY_SERVICE);
                String imei = tMgr.getDeviceId();
                Toast.makeText(getApplicationContext(), imei, Toast.LENGTH_LONG).show();
            } else {
                Log.e(TAG, "No permission to read phone imei");
            }


            //show message
            Toast.makeText(getApplicationContext(), location.toString(), Toast.LENGTH_LONG).show();
            //location.getLongitude()+" "+location.getLatitude());
        }

        @Override
        public void onProviderDisabled(String provider) {
            Log.e(TAG, "onProviderDisabled: " + provider);
        }

        @Override
        public void onProviderEnabled(String provider) {
            Log.e(TAG, "onProviderEnabled: " + provider);
        }
        @Override
        public void onStatusChanged(String provider, int status, Bundle extras) {
            Log.e(TAG, "onStatusChanged: " + provider);
        }
    }

    LocationListener[] mLocationListeners = new LocationListener[] {
            new LocationListener(LocationManager.GPS_PROVIDER),
            new LocationListener(LocationManager.NETWORK_PROVIDER)
    };

    @Override
    public IBinder onBind(Intent arg0)
    {
        return null;
    }

    @Override
    public int onStartCommand(Intent intent, int flags, int startId)
    {
        Log.e(TAG, "onStartCommand");
        super.onStartCommand(intent, flags, startId);
        return START_STICKY;
    }

    @Override
    public void onCreate()
    {
        Log.e(TAG, "onCreate");
        initializeLocationManager();

        //pour garder le service open
        Intent showTaskIntent = new Intent(this, GeoLocalisation.class);
        showTaskIntent.setAction(Intent.ACTION_MAIN);
        showTaskIntent.addCategory(Intent.CATEGORY_LAUNCHER);
        showTaskIntent.addFlags(Intent.FLAG_ACTIVITY_NEW_TASK);

        PendingIntent pendingIntent = PendingIntent.getActivity(this, 0,
                showTaskIntent, 0);

        Notification notification = new Notification.Builder(getApplicationContext())
                .setContentTitle(getString(R.string.app_name))
                .setContentText("Service de géolocalisation des visiteurs médicaux")
                .setSmallIcon(R.drawable.ic_launcher_background)
                .setWhen(System.currentTimeMillis())
                .setContentIntent(pendingIntent)
                .build();
        startForeground(1337, notification);

        //set location config
        try {
            mLocationManager.requestLocationUpdates(
                    LocationManager.NETWORK_PROVIDER, LOCATION_INTERVAL, LOCATION_DISTANCE,
                    mLocationListeners[1]);
        } catch (java.lang.SecurityException ex) {
            Log.i(TAG, "fail to request location update, ignore", ex);
        } catch (IllegalArgumentException ex) {
            Log.d(TAG, "network provider does not exist, " + ex.getMessage());
        }

        try {
            mLocationManager.requestLocationUpdates(
                    LocationManager.GPS_PROVIDER, LOCATION_INTERVAL, LOCATION_DISTANCE,
                    mLocationListeners[0]);
        } catch (java.lang.SecurityException ex) {
            Log.i(TAG, "fail to request location update, ignore", ex);
        } catch (IllegalArgumentException ex) {
            Log.d(TAG, "gps provider does not exist " + ex.getMessage());
        }
    }

    @Override
    public void onDestroy()
    {
        Log.e(TAG, "onDestroy");
        super.onDestroy();
        if (mLocationManager != null) {
            for (int i = 0; i < mLocationListeners.length; i++) {
                try {
                    mLocationManager.removeUpdates(mLocationListeners[i]);
                } catch (Exception ex) {
                    Log.i(TAG, "fail to remove location listners, ignore", ex);
                }
            }
        }
    }

    private void initializeLocationManager() {
        Log.e(TAG, "initializeLocationManager");
        if (mLocationManager == null) {
            mLocationManager = (LocationManager) getApplicationContext().getSystemService(this.getApplicationContext().LOCATION_SERVICE);
        }
    }
}
