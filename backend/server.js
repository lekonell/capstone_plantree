const express = require('express');
const cors = require('cors');
const app = express();
const SERVER_PORT = 4416;

app.listen(SERVER_PORT, () => {
	console.log(`Server Listening at port ${SERVER_PORT}`);
})

app.use(cors({
	origin: "http://srv3.modaweb.kr",
	credentials: true,
	optionsSuccessStatus: 200
}));

const multer = require('multer');
const uploader = multer({ dest: __dirname + '/predict_images/' });

app.post('/', uploader.single('photo'), (req, res) => {
	var img_path = req.file.path;
	var resSended = false;

	const spawn = require('child_process').spawn;
	const result = spawn('python3', ['predict.py', img_path]);

	result.stdout.on('data', function (data) {
		var appData = data.toString();

		if (!resSended) {
			if (appData.indexOf('PREDICTED: ') != -1) {
				var appResult = [];
				for (var i = 1; i <= 3; i++) {
					var splitted = appData.split(`[${i}]`)[1].split(`[/${i}]`)[0];
					appResult.push(splitted);
				}

				res.status(200);
				res.json(JSON.stringify(appResult));
			}
		}
	});

	result.stderr.on('data', function (data) {
		// var appResult = JSON.stringify(data.toString());

		// res.status(200);
		// res.json(appResult);

		// resSended = true;
	});
});

	// {
	// 	fieldname: 'photo',
	// 	originalname: 'a1.png',
	// 	encoding: '7bit',
	// 	mimetype: 'image/png',
	// 	destination: '/home/plantree/predict_images/',
	// 	filename: '4feb53167e0531d02fc232299e5f246b',
	// 	path: '/home/plantree/predict_images/4feb53167e0531d02fc232299e5f246b',
	// 	size: 375014
	// }
