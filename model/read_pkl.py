import pickle
import pandas as pd

def predict_flood(place, water_level, distance_to_river, soil_saturation, river_flow, drainage_capacity, month):
    loaded_model = pickle.load(open('flood_prediction_model.pkl', 'rb'))
    loaded_scaler = pickle.load(open('scaler.pkl', 'rb'))
    # Create a dictionary for the new data point
    new_data = {
        'Water_Level_in_Rain_Gauge': [water_level],
        'Distance_to_River': [distance_to_river],
        'Soil_Saturation': [soil_saturation],
        'River_Flow': [river_flow],
        'Drainage_Capacity': [drainage_capacity],
        'Place_Anuradhapura': [1 if place == 'Anuradhapura' else 0],
        'Place_Batticaloa': [1 if place == 'Batticaloa' else 0],
        'Place_Colombo': [1 if place == 'Colombo' else 0],
        'Place_Kurunegala': [1 if place == 'Kurunegala' else 0],
        'Month_December': [1 if month == 'December' else 0],
        'Month_June': [1 if month == 'June' else 0],
        'Month_March': [1 if month == 'March' else 0],
        'Month_May': [1 if month == 'May' else 0],
        'Month_October': [1 if month == 'October' else 0]
    }

    # Convert the new data to a DataFrame
    new_df = pd.DataFrame(new_data)

    # Reindex to match training data columns
    new_df = new_df.reindex(columns=[
        'Water_Level_in_Rain_Gauge', 'Distance_to_River', 'Soil_Saturation',
        'River_Flow', 'Drainage_Capacity', 'Place_Anuradhapura',
        'Place_Batticaloa', 'Place_Colombo', 'Place_Kurunegala',
        'Month_December', 'Month_June', 'Month_March', 'Month_May',
        'Month_October'
    ], fill_value=0)  

    # Scale the new data using the loaded scaler
    new_df_scaled = loaded_scaler.transform(new_df)

    # Make a prediction using the loaded model
    prediction = loaded_model.predict(new_df_scaled)

    # Output the prediction
    if prediction[0] == 1:
        return "Flood predicted!"
    else:
        return "No flood predicted."

# Example usage 
result = predict_flood(place='Matale', water_level=100.0, distance_to_river=10.0, 
                       soil_saturation=10.0, river_flow=0.0, drainage_capacity=0.1, 
                       month='May')
print(result)