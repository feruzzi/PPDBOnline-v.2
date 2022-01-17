function previewImage(id_img) {
    const image = document.querySelector('#'+id_img);
    const imgPreview = document.querySelector('.img-preview-'+id_img);
    imgPreview.style.display = 'block';
    imgPreview.style.width = '215px';
    imgPreview.style.height = '225px';
    const oFReader=new FileReader();
    oFReader.readAsDataURL(image.files[0]);
    oFReader.onload=function(oFREvent){
        imgPreview.src=oFREvent.target.result;
    }
}