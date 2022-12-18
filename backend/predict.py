import sys
import os
import tensorflow
import matplotlib.pyplot as plt
import numpy as np
from tensorflow import keras
from tensorflow.keras.preprocessing.image import ImageDataGenerator
from tensorflow.keras.models import Model
from keras_preprocessing import image
from keras.models import load_model
import glob
import cv2
from heapq import heappush
from heapq import heappop

loaded_model = load_model('model.h5')
# loaded_model.summary()
loaded_model.compile(optimizer="adam", loss="categorical_crossentropy", metrics=["Accuracy"])

# predicting images
img_width = 224
img_height = 224

classes=['Apple_scab', 'Apple_Black_rot', 'Apple_Cedar_rust',
         'Apple_healthy', 'Blueberry_healthy',
         'Cherry_Powdery_mildew', 'Cherry_healthy',
         'Corn_Cercospora_leaf_spot', 'Corn_Common_rust',
         'Corn_Northern_Leaf_Blight', 'Corn_healthy',
         'Grape_Black_rot', 'Grape_Black_Measles',
         'Grape_Leaf_blight', 'Grape_healthy',
         'Orange_Haunglongbing', 'Peach_Bacterial_spot',
         'Peach_healthy', 'Pepper,_bell_Bacterial_spot', 'Pepper,_bell_healthy',
         'Potato_Early_blight', 'Potato_Late_blight', 'Potato_healthy',
         'Raspberry_healthy', 'Soybean_healthy', 'Squash_Powdery_mildew',
         'Strawberry_Leaf_scorch', 'Strawberry_healthy', 'Tomato_Bacterial_spot',
         'Tomato_Early_blight', 'Tomato_Late_blight', 'Tomato_Leaf_Mold',
         'Tomato_Septoria_leaf_spot', 'Tomato_Spider_mites Two-spotted_spider_mite',
         'Tomato_Target_Spot', 'Tomato_Yellow_Leaf_Curl_Virus',
         'Tomato_mosaic_virus', 'Tomato_healthy']

IMAGE_SIZE = [224, 224]

def load_image(filename):
	img = cv2.imread(filename)
	img = cv2.resize(img, (IMAGE_SIZE[0], IMAGE_SIZE[1]))
	img = img / 255

	return img

def predict(image):
	probabilities = loaded_model.predict(np.asarray([image]))[0]

	probHeap = []
	for idx in range(len(probabilities)):
		heappush(probHeap, (-probabilities[idx], idx))
	
	ret = []
	for i in range(3):
		prob, idx = heappop(probHeap)
		ret.append([classes[idx], -prob])

	return ret

def hsv_filter(img):
	hsv = cv2.cvtColor(img, cv2.COLOR_BGR2HSV)

	mask_green = cv2.inRange(hsv, (36,0,0), (86,255,255))
	mask_brown = cv2.inRange(hsv, (8, 60, 20), (30, 255, 200))
	mask_yellow = cv2.inRange(hsv, (21, 39, 64), (40, 255, 255))

	mask = cv2.bitwise_or(mask_green, mask_brown)
	mask = cv2.bitwise_or(mask, mask_yellow)

	ret = cv2.bitwise_and(img, img, mask=mask)

	return ret

img = load_image(sys.argv[1])
prediction = predict(img)

print("PREDICTED: [1]%s|%f[/1] [2]%s|%f[/2] [3]%s|%f[/3]" % (prediction[0][0], prediction[0][1], prediction[1][0], prediction[1][1], prediction[2][0], prediction[2][1])	)