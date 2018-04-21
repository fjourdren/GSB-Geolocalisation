package com.gsb.ppe.geolocalisation;

public class Config {
    private static final String API_URL = "http://127.0.0.1/";
    private static final String API_ADD_LOCATION = "localisations";

    private static final int LOCATION_INTERVAL = 1000*60*5;
    private static final float LOCATION_DISTANCE = 0.5f;


    public static String getAPI_URL() {
        return API_URL;
    }

    public static String getAPI_ADD_LOCATION() {
        return API_ADD_LOCATION;
    }

    public static int getLOCATION_INTERVAL() {
        return LOCATION_INTERVAL;
    }

    public static float getLOCATION_DISTANCE() {
        return LOCATION_DISTANCE;
    }
}
