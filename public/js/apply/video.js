const videoElem = document.getElementById('stream-elem')

var startBtn = document.getElementById('start-stream')
var endBtn = document.getElementById('stop-media')

var recorder;

const settings = {
    video: true,
    audio: true
}

startBtn.addEventListener('click', function (e) {
    navigator.mediaDevices.getUserMedia(settings).then((stream) => {
        console.log(stream);
        console.log('start-stream');
        console.log(endBtn);
        videoElem.srcObject = stream

        recorder = new MediaRecorder(stream)
        console.log(recorder);

        recorder.start();

        const blobContainer = [];

        recorder.ondataavailable = function (e) {

            blobContainer.push(e.data)
        }

        recorder.onerror = function (e) {
            return console.log(e.error || new Error(e.name));
        }




        recorder.onstop = function (e) {
            console.log(window.URL.createObjectURL(new Blob(blobContainer)));
            console.log('Parando de grabar..');
            //console.log(endBtn);
            var newVideoEl = document.createElement('video')
            newVideoEl.height = '400'
            newVideoEl.width = '600'
            newVideoEl.radius = '10'
            newVideoEl.autoplay = true
            newVideoEl.controls = true
            newVideoEl.innerHTML = `<source src="${window.URL.createObjectURL(new Blob(blobContainer))}"
             type="video/mp4">`
            //document.body.removeChild(videoElem)
            //document.body.insertBefore(newVideoEl, startBtn);

            var formdata = new FormData();
            formdata.append('blobFile', new Blob(blobContainer));
            formdata.append('time', time);
            //alert(formdata)


            fetch('http://localhost:8000/guardar-video', {
                headers: {
                    'X-CSRF-TOKEN': window.CSRF_TOKEN// <--- aquí el token
                },
                method: 'POST',
                body: formdata
            }).then(response => response.json())
                .then(function (data) {
                    if (data.status == 'ok') {
                        console.log('Se subió correctamente');
                        $("#next").trigger("click");
                    } else {
                        console.log('Error');
                        alert('Error al subir el video, por favor grabe de vuelta.');
                        location.reload();
                    }
                });
        }
    })

})



