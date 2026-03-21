
//Global variables
let srGlobal = {s:'',n:'',sub:'',b:'',d:1,i:0};
let ll = [];
         
const saveItem = (id,data) => {
  localStorage.setItem(id,JSON.stringify(data));
}

const getItem = (id) => {
  let ret = '';
  let stringData = localStorage.getItem(id);

  if(stringData){
    ret = JSON.parse(stringData);
  }
  return ret;
} 

const confirmAction = (actionId,callback,text='Are you sure? This action cannot be undone') => {
  const v = confirm(text);

  if(v){
    typeof callback === 'function' && callback(actionId);
  }
  else{
    window.location.reload();
  }

}

const initHTMLEditor = (id='') => {
  CKEDITOR.replace(id);
}

const goTo = (selector) => {
  const elem =  document.querySelector(selector);

  if(elem){
    elem?.scrollIntoView();
  }
 
}

const download = (filename, text) => {
  // Create a Blob object with the file content
  const blob = new Blob([text], { type: 'text/plain' });
  
  // Create an anchor element and set the download attributes
  const element = document.createElement('a');
  element.setAttribute('href', URL.createObjectURL(blob));
  element.setAttribute('download', filename);

  // Append the element to the body, click it, and remove it
  element.style.display = 'none';
  document.body.appendChild(element);
  element.click();
  document.body.removeChild(element);
  
  // Clean up the object URL
  URL.revokeObjectURL(element.href);
}

const renderChart = (selector='',options={}) => {
 

   const chartObj = new ApexCharts(
    document.querySelector(selector),
    options
   ) 
   if(chartObj){
    chartObj?.render()
   }
}

const renderProgressBar = (selector,options={},percentage=100) => {
  const barObj = new ProgressBar.Line(selector,options)
  
  if(barObj){
    const animatedValue = parseFloat(percentage) / 100

    if(!isNaN(animatedValue)){
      barObj?.animate(animatedValue);  // Number from 0.0 to 1.0
    }
   
  }
}

const showCustomAlert = (payload={title:'',text:'',icon:''}) => {
  if(Swal){
    Swal.fire({
     title: payload.title,
     text: payload.text,
     icon: payload.icon
   });
  }
   
}

const copyToClipboard = async (text='') => {
  try {
    await navigator.clipboard.writeText(text);
    alert('Text copied!');
  } catch (err) {
     console.error('Failed to copy to clipboard: ', err);
  }
} 

const sluggify = (text='') => {
text = text.toLowerCase().replace(/"/g,'');
let ret = text;

  try {
    let arr = text.split(' ');

     if(arr.length > 1){
        ret = arr[0];
        for(let a = 1; a < arr.length; a++){
         ret += `-${arr[a]}`;
       }
     }
  } catch (err) {
     console.error('Failed to sluggify: ', err);

  }

  return ret;
} 

const hideFormValidations = () => {
  $('.form-validation, .form-loading, .notify-block').hide();
}

const toggleFormButton = (data={id:'',class:'',mode:''}) => {
  if(data.mode === 'show'){
    if(data.id){
    $(`#${data.id}-loading`).hide();
    $(`#${data.id}-btn`).fadeIn();
    }
    if(data.class){
     $(`.${data.class}-loading`).hide();
     $(`.${data.class}-btn`).fadeIn();
    }
  }
  else if(data.mode === 'hide'){
    if(data.id){
    $(`#${data.id}-btn`).hide();
    $(`#${data.id}-loading`).fadeIn();
    }
    if(data.class){
       $(`.${data.class}-btn`).hide();
    $(`.${data.class}-loading`).fadeIn();
    }
  }
}

const handleResponseError = (data) => {
  let errMessage = 'please try again';
  if(data.message === 'validation'){
   errMessage = 'Some fields are missing or not filled properly. Please check your inputs and try again.';
  }
  if(data.message === 'file-validation'){
    errMessage = 'File is invalid';
   }
  else if(data.message === 'invalid-session'){
    errMessage = 'There was an issue while processing your data. Please contact support';
   }
  else if(data.message === 'invalid-user'){
   errMessage = 'Username or email address invalid, please try again';
  }
  else if(data.message === 'own'){
    errMessage = 'You cannot carry out this action';
   }
  else if(data.message === 'auth'){
    errMessage = 'You must be signed in to continue';
   }
   else if(data.message === 'invalid-auth'){
    errMessage = 'Username or password invalid, please try again';
   }
   else if(data.message === 'payment-failed'){
    errMessage = 'Payment failed';
   }
   else if(data.message === 'insufficient-funds'){
    errMessage = 'You have insufficient withdrawable funds in your wallet';
   }
   else if(data.message === 'kyc'){
    errMessage = 'Your account is pending KYC completion';
   }
   else if(data.message === 'existing-user'){
    errMessage = 'Username or email address already exists';
   }
   else if(data.message === 'invalid-post'){
    errMessage = 'Invalid post';
  }
   else if(data.message === 'past-kickoff'){
    errMessage = 'This prediction is no longer available';
   }
   else if(data.message === 'has-bought'){
     errMessage = 'You have bought this prediction before';
   }
   else if(data.message === 'no-predictions'){
     errMessage = 'No predictions available to add to bet slip';
   }
   else if(data.message === 'no-free-predictions'){
     errMessage = 'No free predictions available in bet slip';
   }
   else if(data.message === 'no-virgin-predictions'){
    errMessage = 'No  predictions have been added yet';
  }
  else if(data.message === 'invalid-predictions'){
    errMessage = 'Invalid prediction';
  }
  else if(data.message === 'invalid-member-request'){
    errMessage = 'Invalid request, please contact support';
  }
  else if(data.message === 'invalid-event'){
    errMessage = 'Invalid event, please contact support';
  }

  alert(errMessage);
}

const notify = (id='') => {
  $(`#${id}`).fadeIn();

   setTimeout(() => {
     $(`#${id}`).fadeOut();
  },3000);
}

const fetchWithFormData = async (payload={url:'',method:'POST',fd:(new FormData())},successCallback,errorCallback) => {
  const url = payload.url
  const response =  await fetch(url, {
    method: payload.method,
    body: payload.fd
  })
  if(response.status === 200){
    const responseJSON = await response.json()
     successCallback(responseJSON)
  }
  else{
   const ret = {status: 'error', message: `Request failed with status code: ${response.status}`}
   errorCallback(ret)
  }
}

const fetchWithJson = async (payload={url:'',method:'POST',data:[{key:'',value:''}]},successCallback,errorCallback) => {
  let response = null;
  const hasPayload = payload.data && payload.data.length > 0;

  if(payload.method === 'GET'){
    let paramString = ``

    if(hasPayload){
       for(const d of payload.data){
         paramString += `&${d.key}=${d.value}`
       }
    }
    const url = `${payload.url}?${paramString}`
     response = await fetch(url, {
        method: "GET",
      })
  }
  else{
    const fd = new FormData()
   
    if(hasPayload){
      for(const d of payload.data){
        fd.append(`${d.key}`,d.value)
      }
    }
    
    response = await fetch(payload.url, {
        method: payload.method,
        body: fd
      })
  }

  if(response?.status === 200){
    const responseJSON = await response?.json()
     successCallback(responseJSON)
  }
  else{
   const ret = {status: 'error', message: `Request failed with status code: ${response?.status}`}
   errorCallback(ret)
  }
}

const onlyUnique = (value1={}, index=0, array=[]) => {
  return array.findIndex(value2 => (value1.value === value2.value)) === index;
}

const removeDuplicatesFromArray = (arr=[]) => {
 const ret = arr.filter(onlyUnique);
 return ret;
}

const initAutoCompleteInput = ({
  id='',
  placeholder='',
  data=[],
  keys=[],
  onSelect=(data={}) => {}
}) => {
   const ret = new autoComplete({
      selector: `#${id}`,
      placeHolder: placeholder,
      data: {
         src: data,//["Sauce - Thousand Island", "Wild Boar - Tenderloin", "Goat - Whole Cut"],
         keys,
         cache: false,
      },
      threshold: 0,
      resultsList: {
        element: (list, data) => {
           const filteredData = removeDuplicatesFromArray(data.results);
          if (!filteredData.length) {
            // Create "No Results" message element
            const message = document.createElement("div");
            // Add class to the created element
            message.setAttribute("class", "no_result");
            // Add message text content
            message.innerHTML = `<span>Found No Results for "${data.query}"</span>`;
            // Append message element to the results list
            list.prepend(message);
          }
        },
        maxResults: undefined,
        noResults: true,
      },
      resultItem: {
         highlight: true,
      },
      events: {
            input: {
                selection: (event) => {
                    const selection = event.detail.selection.value;
                    onSelect(selection);
                    //ret.input.value = selection;
                }
            }
        }
   });

   return ret;
 }


 const contact = async (payload={n:'',s:'',e:'',b:''},successCallback,errorCallback) => {
  const url = 'api/contact';

  await fetchWithJson(
    {
      url,
      method: 'POST',
      data: [
        {key: 'name',value: payload.n},
        {key: 'body',value: payload.b},
        {key: 'subject',value: payload.s},
        {key: 'email',value: `${payload.e}`}
      ],
    },
    successCallback,
    errorCallback
  );
 
}



const login = async (payload={u:'',p:'',r:false},successCallback,errorCallback) => {
    const url = 'api/login';
    await fetchWithJson(
      {
         url,
         method: 'POST',
         data: [
          {key: 'username',value: payload.u},
          {key: 'password',value: payload.p},
          {key: 'remember',value: payload.r}
        ],
      },
      successCallback,
      errorCallback
    );
   
}

const apply = async (payload={f:'',l:'',e:'',ph:''},successCallback,errorCallback) => {
  const url = 'api/apply';

  await fetchWithJson(
    {
      url,
      method: 'POST',
      data: [
        {key: 'fname',value: payload.f},
        {key: 'lname',value: payload.l},
        {key: 'phone',value: payload.ph},
        {key: 'email',value: `${payload.e}`}
      ],
    },
    successCallback,
    errorCallback
  );
 
}


const signup = async (payload={f:'',l:'',e:'',t:'',ph:'',p:'',p2:'',g:''},successCallback,errorCallback) => {
  const url = 'api/complete-registration';

  await fetchWithJson(
    {
      url,
      method: 'POST',
      data: [
        {key: 'fname',value: payload.f},
        {key: 'lname',value: payload.l},
        {key: 'password',value: payload.p},
        {key: 'password_confirmation',value: payload.p2},
        {key: 'phone',value: payload.ph},
        {key: 'email',value: `${payload.e}`},
        {key: 'gender',value: `${payload.g}`},
      ],
    },
    successCallback,
    errorCallback
  );
 
}

const forgotPassword = async (payload={u:''},successCallback,errorCallback) => {
  const url = 'api/forgot-password';

  await fetchWithJson(
    {
      url,
      method: 'POST',
      data: [
        {key: 'id',value: payload.u},
      ],
    },
    successCallback,
    errorCallback
  );
 
}

const reset = async (payload={p:'',p2:'',x:''},successCallback,errorCallback) => {
  const url = 'api/reset-password';

  await fetchWithJson(
    {
      url,
      method: 'POST',
      data: [
        {key: 'password',value: payload.p},
        {key: 'password_confirmation',value: payload.p2},
        {key: 'xf',value: payload.x}
      ],
    },
    successCallback,
    errorCallback
  );
 
}

const changePassword = async (payload={p:'',p2:''},successCallback,errorCallback) => {
  const url = 'api/change-password';

  await fetchWithJson(
    {
      url,
      method: 'POST',
      data: [
        {key: 'password',value: payload.p},
        {key: 'password_confirmation',value: payload.p2},
      ],
    },
    successCallback,
    errorCallback
  );
 
}

const uploadAvatar = async (payload={pf:''},successCallback,errorCallback) => {
  const url = 'api/upload-avatar';

  await fetchWithJson(
    {
      url,
      method: 'POST',
      data: [
        {key: 'pf',value: payload.pf}
      ],
    },
    successCallback,
    errorCallback
  );
 
}

const donate = async (payload={f:'',l:'',e:'',a:''},successCallback,errorCallback) => {
  const url = 'api/donate';

  await fetchWithJson(
    {
      url,
      method: 'POST',
      data: [
        {key: 'fname',value: `${payload.f}`},
        {key: 'lname',value: `${payload.l}`},
        {key: 'email',value: `${payload.e}`},
        {key: 'amount',value: `${payload.a}`},
      ],
    },
    successCallback,
    errorCallback
  );
 
}

const cf = async (payload={f:'',l:'',e:'',a:''},successCallback,errorCallback) => {
  const url = 'api/cf';

  await fetchWithJson(
    {
      url,
      method: 'POST',
      data: [
        {key: 'fname',value: `${payload.f}`},
        {key: 'lname',value: `${payload.l}`},
        {key: 'email',value: `${payload.e}`},
        {key: 'amount',value: `${payload.a}`},
      ],
    },
    successCallback,
    errorCallback
  );
 
}

const gsl = async (payload={xf:''},successCallback,errorCallback) => {
  const url = 'api/gsl';

  await fetchWithJson(
    {
      url,
      method: 'POST',
      data: [
        {key: 'xf',value: `${payload.xf}`},
      ],
    },
    successCallback,
    errorCallback
  );
 
}

const aa = async (payload={t:'',m:''},successCallback,errorCallback) => {
  const url = 'api/aa';

  await fetchWithJson(
    {
      url,
      method: 'POST',
      data: [
        {key: 'title',value: `${payload.t}`},
        {key: 'msg',value: `${payload.m}`},
      ],
    },
    successCallback,
    errorCallback
  );
 
}

const rsm = async (payload={xf:''},successCallback,errorCallback) => {
  const url = 'api/rsm';

  await fetchWithJson(
    {
      url,
      method: 'POST',
      data: [
        {key: 'xf',value: `${payload.xf}`},
      ],
    },
    successCallback,
    errorCallback
  );
 
}

const ac = async (payload=new FormData(),successCallback,errorCallback) => {
  const url = 'api/add-category';

  await fetchWithFormData(
    {
      url,
      method: 'POST',
      fd: payload,
    },
    successCallback,
    errorCallback
  );
 
}

const rc = async (payload={xf:''},successCallback,errorCallback) => {
  const url = 'api/remove-category';

  await fetchWithJson(
    {
      url,
      method: 'POST',
      data: [
        {key: 'xf',value: `${payload.xf}`},
      ],
    },
    successCallback,
    errorCallback
  );
 
}

const ab = async (payload=new FormData(),successCallback,errorCallback) => {
  const url = 'api/add-brand';

  await fetchWithFormData(
    {
      url,
      method: 'POST',
      fd: payload,
    },
    successCallback,
    errorCallback
  );
 
}

const rb = async (payload={xf:''},successCallback,errorCallback) => {
  const url = 'api/remove-brand';

  await fetchWithJson(
    {
      url,
      method: 'POST',
      data: [
        {key: 'xf',value: `${payload.xf}`},
      ],
    },
    successCallback,
    errorCallback
  );
 
}

const ap = async (payload=new FormData(),successCallback,errorCallback) => {
  const url = 'api/add-product';

  await fetchWithFormData(
    {
      url,
      method: 'POST',
      fd: payload,
    },
    successCallback,
    errorCallback
  );
 
}

const rp = async (payload={xf:''},successCallback,errorCallback) => {
  const url = 'api/remove-product';

  await fetchWithJson(
    {
      url,
      method: 'POST',
      data: [
        {key: 'xf',value: `${payload.xf}`},
      ],
    },
    successCallback,
    errorCallback
  );
 
}

const agi = async (payload=new FormData(),successCallback,errorCallback) => {
  const url = 'api/add-gallery-item';

  await fetchWithFormData(
    {
      url,
      method: 'POST',
      fd: payload,
    },
    successCallback,
    errorCallback
  );
 
}

const afp = async (payload=new FormData(),successCallback,errorCallback) => {
  const url = 'api/add-fp';

  await fetchWithFormData(
    {
      url,
      method: 'POST',
      fd: payload,
    },
    successCallback,
    errorCallback
  );
 
}

const rfp = async (payload={xf:''},successCallback,errorCallback) => {
  const url = 'api/remove-fp';

  await fetchWithJson(
    {
      url,
      method: 'POST',
      data: [
        {key: 'xf',value: `${payload.xf}`},
      ],
    },
    successCallback,
    errorCallback
  );
 
}

const afc = async (payload={t:'',s:''},successCallback,errorCallback) => {
  const url = 'api/add-fc';

  await fetchWithJson(
    {
      url,
      method: 'POST',
      data: [
        {key: 'title',value: `${payload.t}`},
        {key: 'slug',value: `${payload.s}`},
      ],
    },
    successCallback,
    errorCallback
  );
 
}

const rfc = async (payload={xf:''},successCallback,errorCallback) => {
  const url = 'api/remove-fc';

  await fetchWithJson(
    {
      url,
      method: 'POST',
      data: [
        {key: 'xf',value: `${payload.xf}`},
      ],
    },
    successCallback,
    errorCallback
  );
 
}

const cp = async (payload={xf:'',b:''},successCallback,errorCallback) => {
  const url = 'api/comment-post';

  await fetchWithJson(
    {
      url,
      method: 'POST',
      data: [
        {key: 'xf',value: `${payload.xf}`},
        {key: 'body',value: `${payload.b}`},
      ],
    },
    successCallback,
    errorCallback
  );
 
}

const rcc = async (payload={xf:''},successCallback,errorCallback) => {
  const url = 'api/rcc';

  await fetchWithJson(
    {
      url,
      method: 'POST',
      data: [
        {key: 'xf',value: `${payload.xf}`},
      ],
    },
    successCallback,
    errorCallback
  );
 
}


const ruc = async (payload={xf:''},successCallback,errorCallback) => {
  const url = 'api/ruc';

  await fetchWithJson(
    {
      url,
      method: 'POST',
      data: [
        {key: 'xf',value: `${payload.xf}`},
      ],
    },
    successCallback,
    errorCallback
  );
 
}

const cfb = async (successCallback,errorCallback) => {
  const url = `api/cfb`;

  await fetchWithJson(
    {
       url,
       method: 'GET',
       data: [],
    },
    successCallback,
    errorCallback
  );
 
}

const rd = async (payload={xf:''},successCallback,errorCallback) => {
  const url = 'api/remove-donation';

  await fetchWithJson(
    {
      url,
      method: 'POST',
      data: [
        {key: 'xf',value: `${payload.xf}`},
      ],
    },
    successCallback,
    errorCallback
  );
 
}

const cd = async (payload={xf:''},successCallback,errorCallback) => {
  const url = 'api/confirm-donation';

  await fetchWithJson(
    {
      url,
      method: 'POST',
      data: [
        {key: 'xf',value: `${payload.xf}`},
      ],
    },
    successCallback,
    errorCallback
  );
 
}


const addSetting = async (payload={n:'',v:''},successCallback,errorCallback) => {
  const url = 'api/add-setting';

  await fetchWithJson(
    {
      url,
      method: 'POST',
      data: [
        {key: 'name',value: payload.n},
        {key: 'value',value: payload.v},
      ],
    },
    successCallback,
    errorCallback
  );
 
}

const updateSetting = async (payload={n:'',v:'',xf:''},successCallback,errorCallback) => {
  const url = 'api/setting';

  await fetchWithJson(
    {
      url,
      method: 'POST',
      data: [
        {key: 'name',value: payload.n},
        {key: 'value',value: payload.v},
        {key: 'xf',value: payload.xf},
      ],
    },
    successCallback,
    errorCallback
  );
 
}

const removeSetting = async (payload={xf:''},successCallback,errorCallback) => {
  const url = `api/remove-setting?${xf=payload.xf}`;

  await fetchWithJson(
    {
      url,
      method: 'POST',
    },
    successCallback,
    errorCallback
  );
 
}



const updateUser = async (payload={xf:'',op:''},successCallback,errorCallback) => {
  const url = 'api/user';

  await fetchWithJson(
    {
      url,
      method: 'POST',
      data: [
        {key: 'xf',value: payload.xf},
        {key: 'op',value: payload.op},
      ],
    },
    successCallback,
    errorCallback
  );
 
}

const uk= async (payload={xf:''},successCallback,errorCallback) => {
  updateUser({
    xf: payload.xf,
    op: 'kyc'
  },successCallback,errorCallback);
}



const addPlugin = async (payload={n:'',v:''},successCallback,errorCallback) => {
  const url = 'api/add-plugin';
  await fetchWithJson(
    {
      url,
      method: 'POST',
      data: [
        {key: 'name',value: payload.n},
        {key: 'value',value: payload.v},
      ],
    },
    successCallback,
    errorCallback
  );
}

const removePlugin = async (payload={xf:''},successCallback,errorCallback) => {
  const url = `api/remove-plugin`

  await fetchWithJson(
    {
       url,
       method: 'POST',
       data: [
        {key: 'xf',value:payload.xf}
      ],
    },
    successCallback,
    errorCallback
  )
 
}


const addSender = async (payload={ss:'',sp:'',sec:'',sa:'',su:'',spp:'',sn:'',se:''},successCallback,errorCallback) => {
  const url = 'api/add-sender';
  await fetchWithJson(
    {
      url,
      method: 'POST',
      data: [
        {key: 'ss',value: payload.ss},
        {key: 'sp',value: payload.sp},
        {key: 'sec',value: payload.sec},
        {key: 'sa',value: payload.sa},
        {key: 'su',value: payload.su},
        {key: 'spp',value: payload.spp},
        {key: 'sn',value: payload.sn},
        {key: 'se',value: payload.se},
      ],
    },
    successCallback,
    errorCallback
  );
}

const removeSender = async (payload={xf:''},successCallback,errorCallback) => {
  const url = `api/remove-sender`;

  await fetchWithJson(
    {
       url,
       method: 'POST',
       data: [
        {key: 'xf',value:payload.xf}
      ],
    },
    successCallback,
    errorCallback
  );
 
}

const updateSender = async (payload={xf:''},successCallback,errorCallback) => {
  const url = `api/sender`;

  await fetchWithJson(
    {
       url,
       method: 'POST',
       data: [
        {key: 'xf',value:payload.xf},
        {key: 'cr',value:'u'},
      ],
    },
    successCallback,
    errorCallback
  );
 
}



const addAd = async (payload={n:'',i:'',v:''},successCallback,errorCallback) => {
  const url = 'api/add-ad';
  await fetchWithJson(
    {
      url,
      method: 'POST',
      data: [
        {key: 'name',value: payload.n},
        {key: 'image',value: payload.i},
        {key: 'value',value: payload.v},
      ],
    },
    successCallback,
    errorCallback
  );
}

const removeAd = async (id,successCallback,errorCallback) => {
  const url = `api/remove-ad`;

  await fetchWithJson(
    {
       url,
       method: 'GET',
       data: [
        {key: 'xf',value:id}
      ],
    },
    successCallback,
    errorCallback
  );
 
}

const addBanner = async (payload={
  title,
  subtitle,
  image,
  points,
  description,
  btn_url_1,
  btn_text_1,
  btn_url_2,
  btn_text_2
}
  ,successCallback,errorCallback) => {
  const url = 'api/add-banner';
  await fetchWithJson(
    {
      url,
      method: 'POST',
      data: [
        {key: 'title',value: payload.title},
        {key: 'subtitle',value: payload.subtitle},
        {key: 'image',value: payload.image},
        {key: 'points',value: payload.points},
        {key: 'description',value: payload.description},
        {key: 'btn_url_1',value: payload.btn_url_1},
        {key: 'btn_text_1',value: payload.btn_text_1},
        {key: 'btn_url_2',value: payload.btn_url_2},
        {key: 'btn_text_2',value: payload.btn_text_2},
      ],
    },
    successCallback,
    errorCallback
  );
}

const removeBanner = async (id,successCallback,errorCallback) => {
  const url = `api/remove-ad`;

  await fetchWithJson(
    {
       url,
       method: 'GET',
       data: [
        {key: 'xf',value:id}
      ],
    },
    successCallback,
    errorCallback
  );
 
}



const bomb = (
  payload={s:'',n:'',sub:'',b:'',d:1,i:0},
successCallback,
errorCallback
) => {
  let url = `api/bomb`;
  srGlobal = payload;
  toggleFormButton({id: 'sr',mode: 'hide'});


  console.log('qq: ',ll[payload.i]);
const dt = new FormData();
dt.append('sender',payload.s);
dt.append('subject',payload.sub);
dt.append('to',ll[payload.i]);
dt.append('sname',payload.n);
dt.append('body',payload.b);


$.ajax({ 
 type : 'POST',
 url  : url,
 data : dt,
 processData: false,
 contentType: false,
 beforeSend: () => {
  //$("#sr-loading").html('<div class="alert alert-info" role="alert" style=" text-align: center;"><strong class="block" style="font-weight: bold;">  Processing <img src="images/loading.gif" class="img img-esponsive" style="width: 20px; height: 20px;"></strong></div>');

 },
 success : (response) => {
  toggleFormButton({id: 'bomb',mode: 'show'});
    let ret = JSON.parse(response);

    
   if(ret['status'] == "ok" || ret['status'] == "sent"){
     $('#bomb-results').append("<p class='text-success'>Email sent to " + ret['to'] + "</p>")   
   }
   else{
     $('#bomb-results').append("<p class='text-danger'>An error occured sending to " + ret['to'] + "</p>")
   }
   
   
   setTimeout(function(){
    
     const ff = srGlobal.i + 1;
     
      if(ff <= ll.length - 1){
        bomb({
          i: srGlobal.i + 1,
          d: srGlobal.d,
          b: srGlobal.b,
          n: srGlobal.n,
          s: srGlobal.s,
          sub: srGlobal.sub
        },
        successCallback,
        errorCallback
      );
      }
      else{
        typeof successCallback === 'function' && successCallback();
      }
     },srGlobal.d * 1000);
   
   },
   error: (err) => {
    typeof errorCallback === 'function' && errorCallback(err)
   }
 })
}




const bomb2 = (
  {
    ll=[],
    subject='',
    msg='',
  },
successCallback,
errorCallback
) => {
  let url = `api/send-email`

const to = ll[emailIndex],dt = new FormData()
dt.append('msg',msg)
dt.append('subject',subject)
dt.append('to',to)

$('#logs-loading').fadeIn()
$('#mailer-results').fadeIn()


$.ajax({ 
 type : 'POST',
 url  : url,
 data : dt,
 processData: false,
 contentType: false,
 beforeSend: () => {
  $("#logs-loading").html('<div class="alert alert-info" role="alert" style=" text-align: center;"><strong class="block" style="font-weight: bold;">  Processing <img src="images/loading.gif" class="img img-esponsive" style="width: 20px; height: 20px;"></strong></div>');

 },
 success : (response) => {
   $('#logs-loading').hide()
    let ret = JSON.parse(response)
   console.log({response})
    
   if(ret['status'] == "ok" || ret['status'] == "sent"){
     $('#mailer-results').append("<p class='text-success'>Email sent to " + to + "</p>")   
   }
   else{
     $('#mailer-results').append("<p class='text-danger'>An error occured sending to " + to + "</p>")
   }
   
   
   setTimeout(function(){
     //console.log("data sent: " + dt);
     ++emailIndex; 
      if(emailIndex <= ll.length){
        bomb({ll,subject,msg})
      } 
      else{
        typeof successCallback === 'function' && successCallback()
      }
     },5000)
   
   },
   error: (err) => {
    typeof errorCallback === 'function' && errorCallback(err)
   }
 })
}





