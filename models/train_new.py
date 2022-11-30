import os
import tensorflow
import matplotlib.pyplot as plt
from tensorflow import keras
from tensorflow.keras.preprocessing.image import ImageDataGenerator
from tensorflow.keras.models import Model

EPOCH = 5
BATCH_SIZE = 128
STEPS_PER_EPOCH = 549

training_dir = './dataset/train'
validation_dir = './dataset/valid'

training_set = ImageDataGenerator(
    rescale=1/255.5
)
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
model4 = Model(inputs=input_layer, outputs=output_layer)
model4.summary()
model4.compile(optimizer="adam", loss="categorical_crossentropy", metrics=["Accuracy"])
result4 = model4.fit(
    training_data,
    validation_data=validation_data,
    epochs=EPOCH,
    steps_per_epoch=STEPS_PER_EPOCH
)

model4.save('model4.h5')

plt.plot(result4.history['Accuracy'])
plt.plot(result4.history['val_Accuracy'])
plt.title('model accuracy')
plt.ylabel('accuracy')
plt.xlabel('epoch')
plt.legend(['train', 'val'], loc='upper left')
plt.show()

plt.plot(result4.history['loss'])
plt.plot(result4.history['val_loss'])
plt.title('model loss')
plt.ylabel('loss')
plt.xlabel('epoch')
plt.legend(['train', 'val'], loc='upper left')
plt.show()