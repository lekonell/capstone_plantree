import os
import tensorflow
import matplotlib.pyplot as plt
import numpy as np
from tensorflow import keras
from tensorflow.keras.preprocessing.image import ImageDataGenerator
from tensorflow.keras.models import Model
from keras_preprocessing import image
from keras.models import load_model
# from keras.utils.np_utils import probas_to_classes
import glob
import cv2

BATCH_SIZE = 128

training_dir = './dataset/train'
training_set = ImageDataGenerator(rescale=1/255.5)
training_data = training_set.flow_from_directory(
    training_dir,
    target_size=(224, 224),
    class_mode="categorical",
    batch_size=BATCH_SIZE
)

categories = training_data.class_indices.keys()

'''
EPOCH = 5
BATCH_SIZE = 128
STEPS_PER_EPOCH = 549

training_dir = './dataset/train'
validation_dir = './dataset/valid'

training_set = ImageDataGenerator(rescale=1/255.5)
training_data = training_set.flow_from_directory(
    training_dir,
    target_size=(224, 224),
    class_mode="categorical",
    batch_size=BATCH_SIZE
)

validation_set = ImageDataGenerator(rescale=1/255.5)
validation_data = validation_set.flow_from_directory(
    validation_dir,
    target_size=(224, 224),
    class_mode="categorical",
    batch_size=BATCH_SIZE
)


categories = training_data.class_indices.keys()
print(categories)

mobilenetv2 = keras.applications.mobilenet_v2.MobileNetV2(
    include_top=False,
    input_shape=(224, 224, 3)
)
mobilenetv2.trainable = False

input_layer = keras.Input(shape=(224, 224, 3))
x = mobilenetv2(input_layer, training=False)
x = keras.layers.GlobalAveragePooling2D()(x)
x = keras.layers.Dropout(0.1)(x)
x = keras.layers.Dense(512, activation='relu')(x)
output_layer = keras.layers.Dense(len(categories), activation="softmax")(x)
'''

loaded_model = load_model('model.h5')
loaded_model.summary()
loaded_model.compile(optimizer="adam", loss="categorical_crossentropy", metrics=["Accuracy"])
# score = loaded_model.evaluate(X, Y, verbose=0)
# print("%s: %.2f%%" % (loaded_model.metrics_names[1], score[1]*100))

# predicting images
img_width = 224
img_height = 224

img = image.load_img('./dataset/test/AppleCedarRust2.JPG', target_size=(img_width, img_height))
# img = image.load_img('./dataset/test/AppleCedarRust3.JPG', target_size=(img_width, img_height))
# img = image.load_img('./dataset/train/Grape___healthy/0dca4cc0-2f37-4d55-8060-ce5e2137fd45___Mt.N.V_HL 9077_180deg.JPG', target_size=(img_width, img_height))
# img = image.load_img('./dataset/test/TomatoYellowCurlVirus6.JPG', target_size=(img_width, img_height))
img = image.load_img('./dataset/test/PotatoEarlyBlight3.JPG', target_size=(img_width, img_height))
x = image.img_to_array(img)
x = np.expand_dims(x, axis=0)

images = np.vstack([x])
prediction = loaded_model.predict(images, batch_size=1)
classPrediction = np.argmax(prediction, axis=-1)
print(prediction)
print(classPrediction)

classesSorted = sorted(list(categories))
print(classesSorted[classPrediction[0]])
# print(classes)

'''
max_probability = max(classes[0])
print(classes[0])
print(max_probability)

max_idx = classes[0].index(max_probability)
print(max_idx)
'''

classes=['Apple_scab', 'Apple_Black_rot', 'Cedar_apple_rust',
         'Apple_healthy', 'Blueberry_healthy',
         'Cherry_Powdery_mildew', 'Cherry_healthy',
         'Corn_Cercospora_leaf_spot', 'Corn_Common_rust_',
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
         'Tomato_Target_Spot', 'Tomato_Tomato_Yellow_Leaf_Curl_Virus',
         'Tomato_Tomato_mosaic_virus', 'Tomato_healthy']

IMAGE_SIZE = [224, 224]

def load_image(filename):
    img = cv2.imread(filename)
    img = cv2.resize(img, (IMAGE_SIZE[0], IMAGE_SIZE[1]))
    img = img / 255

    return img

def predict(image):
    probabilities = loaded_model.predict(np.asarray([img]))[0]
    class_idx = np.argmax(probabilities)

    return {classes[class_idx]: probabilities[class_idx]}

path ='./dataset/test/'
PList = glob.glob('./dataset/test/*')
for filename in PList:
    img = load_image(str(filename))
    prediction = predict(img)
    print("ACTUAL CLASS: %s, PREDICTED: class: %s, confidence: %f" % (os.path.basename(filename), list(prediction.keys())[0], list(prediction.values())[0]))