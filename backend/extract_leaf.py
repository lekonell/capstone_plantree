import cv2

def hsv_filter(img):
	hsv = cv2.cvtColor(img, cv2.COLOR_BGR2HSV)

	mask_green = cv2.inRange(hsv, (36,0,0), (86,255,255))
	mask_brown = cv2.inRange(hsv, (8, 60, 20), (30, 255, 200))
	mask_yellow = cv2.inRange(hsv, (21, 39, 64), (40, 255, 255))

	mask = cv2.bitwise_or(mask_green, mask_brown)
	mask = cv2.bitwise_or(mask, mask_yellow)

	ret = cv2.bitwise_and(img, img, mask=mask)

	return ret

img = cv2.imread('./dataset/test/test.JPG')
hsv_img = hsv_filter(img)

cv2.imshow("original", img)
cv2.imshow("final image", hsv_img)
cv2.waitKey(0)
cv2.destroyAllWindows()