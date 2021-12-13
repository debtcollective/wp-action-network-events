!function(){var e,t={115:function(e,t,n){"use strict";var a={};n.r(a),n.d(a,{category:function(){return E},name:function(){return b},settings:function(){return x}});var o={};n.r(o),n.d(o,{category:function(){return O},name:function(){return j},settings:function(){return F}});var r={};n.r(r),n.d(r,{category:function(){return B},name:function(){return z},settings:function(){return L}});var l={};n.r(l),n.d(l,{category:function(){return R},name:function(){return H},settings:function(){return V}});var s={};n.r(s),n.d(s,{category:function(){return Z},name:function(){return U},settings:function(){return J}});var i={};n.r(i),n.d(i,{category:function(){return oe},name:function(){return ae},settings:function(){return re}});var c=window.wp.blocks,u=window.wp.i18n;const p={name:"events-by-tag-welcome-calls",title:(0,u.__)("Welcome Calls","wp-action-network-events"),description:(0,u.__)("Display welcome call events with section header and description..","wp-action-network-events"),icon:"calendar-alt",category:"components",keywords:[(0,u.__)("event","wp-action-network-events"),(0,u.__)("grid","wp-action-network-events"),(0,u.__)("component","wp-action-network-events")],attributes:{className:"events-by-tag welcome-calls"},innerBlocks:[["core/heading",{className:"taxonomy-label",level:2,placeholder:(0,u.__)("Add Title...","wp-action-network-events"),content:(0,u.__)("Welcome Calls","wp-action-network-events")}],["core/paragraph",{className:"taxonomy-description",placeholder:(0,u.__)("Add Description...","wp-action-network-events"),content:(0,u.__)("Are you new to the Debt Collective or the Biden Jubilee 100 campaign and want to learn more about our union and what we’re fighting for? Join us for our welcome calls!","wp-action-network-events")}],["wp-action-network-events/event-query",{query:{per_page:3,order:"desc",orderby:"start","event-tags":[10]},eventTags:"10",dateFormat:"D, M j",timeFormat:"g:ia",display:{showTags:!1,showFeaturedImage:!1,showTitle:!1,showDate:!0,showTime:!0,showEndTime:!1,showLocation:!0}}]],scope:["block","inserter","transform"]},d={name:"events-by-tag",title:(0,u.__)("Events by Tag","wp-action-network-events"),icon:"calendar-alt",category:"components",keywords:[(0,u.__)("event","wp-action-network-events"),(0,u.__)("grid","wp-action-network-events"),(0,u.__)("component","wp-action-network-events")],attributes:{className:"events-by-tag"},innerBlocks:[["core/heading",{className:"taxonomy-label",level:2,placeholder:(0,u.__)("Add Title...","wp-action-network-events")}],["core/paragraph",{className:"taxonomy-description",placeholder:(0,u.__)("Add Description...","wp-action-network-events")}],["wp-action-network-events/event-query",{query:{per_page:3,order:"desc",orderby:"start"},dateFormat:"l F j, Y",display:{showTags:!1,showFeaturedImage:!1,showTitle:!0,showDate:!0,showTime:!0,showEndTime:!0,showLocation:!0}}]],scope:["block","inserter","transform"]};(0,c.registerBlockVariation)("wp-action-network-events/events",p),(0,c.registerBlockVariation)("wp-action-network-events/events",d);var m=window.wp.element,v=window.wp.primitives,f=(0,m.createElement)(v.SVG,{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24"},(0,m.createElement)(v.Path,{d:"M11.696 13.972c.356-.546.599-.958.728-1.235a1.79 1.79 0 00.203-.783c0-.264-.077-.47-.23-.618-.148-.153-.354-.23-.618-.23-.295 0-.569.07-.82.212a3.413 3.413 0 00-.738.571l-.147-1.188c.289-.234.59-.41.903-.526.313-.117.66-.175 1.041-.175.375 0 .695.08.959.24.264.153.46.362.59.626.135.265.203.556.203.876 0 .362-.08.734-.24 1.115-.154.381-.427.87-.82 1.466l-.756 1.152H14v1.106h-4l1.696-2.609z"}),(0,m.createElement)(v.Path,{d:"M19.5 7h-15v12a.5.5 0 00.5.5h14a.5.5 0 00.5-.5V7zM3 7V5a2 2 0 012-2h14a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V7z"})),w=JSON.parse('{"apiVersion":2,"name":"wp-action-network-events/event-date","title":"Event Date","category":"theme","description":"Display event date in event query.","textdomain":"wp-action-network-events","attributes":{"format":{"type":"string"}},"usesContext":["postId","postType","queryId"],"parent":["core/post-template"],"supports":{"html":false,"color":{"gradients":false,"link":false,"text":false,"background":false},"typography":{"fontSize":false,"lineHeight":false,"__experimentalFontWeight":false}},"style":"file:../../build/style-index.css","editorScript":"wp-action-network-events","editorStyle":"file:../../build/index.css"}'),g=window.wp.coreData,y=window.wp.data,_=window.wp.date,h=window.wp.blockEditor,k=window.wp.components;const{name:b,category:E}=w,x={icon:f,edit:e=>{let{attributes:{format:t},context:{postId:n,postType:a,queryId:o},setAttributes:r}=e;const[l]=(0,g.useEntityProp)("root","site","date_format"),[s]=(0,g.useEntityProp)("postType",a,"meta",n,!0),i=s._start_date,c=(0,_.__experimentalGetSettings)(),p=(/a(?!\\)/i.test(c.formats.time.toLowerCase().replace(/\\\\/g,"").split("").reverse().join("")),Object.values(c.formats).map((e=>({key:e,name:(0,_.dateI18n)(e,i)})))),d=t||l||c.formats.date;let v=i?(0,m.createElement)("time",{dateTime:(0,_.dateI18n)("c",i)},(0,_.dateI18n)(d,i)):(0,u.__)("No Event Date","wp-action-network-events");const f=(0,h.useBlockProps)();return(0,m.createElement)(m.Fragment,null,(0,m.createElement)(h.InspectorControls,null,(0,m.createElement)(k.PanelBody,{title:(0,u.__)("Date Format Settings","wp-action-network-events")},(0,m.createElement)(k.CustomSelectControl,{hideLabelFromVision:!0,label:(0,u.__)("Date Format","wp-action-network-events"),options:p,onChange:e=>{let{selectedItem:t}=e;return r({format:t.key})},value:p.find((e=>e.key===d))}))),(0,m.createElement)("div",f,v))}};var S=JSON.parse('{"apiVersion":2,"version":"1.0.0","textdomain":"wp-action-network-events","name":"wp-action-network-events/events","title":"Events Component","category":"components","collection":"wp-action-network-events","icon":"calendar-alt","className":"events","description":"Display events with section header and description.","keywords":["events","section"],"supports":{"align":false,"anchor":true,"color":{"background":false,"text":false,"gradients":false,"link":false},"customClassName":true,"defaultStylePicker":false,"__experimentalLayout":false},"attributes":{"tagName":{"type":"div"}},"variations":[],"styles":[],"example":{},"style":"file:../../build/style-index.css","editorScript":"wp-action-network-events","editorStyle":"file:../../build/index.css"}'),T=n(184),I=n.n(T);const C=[["core/heading",{placeholder:(0,u.__)("Add Heading...","wp-action-network-events"),level:2,className:"events__title"},[]],["core/paragraph",{placeholder:(0,u.__)("Add Content...","wp-action-network-events"),className:"events__content"},[]],["wp-action-network-events/event-query",{className:"events__list"},[]]],N=["core/heading","core/paragraph","wp-action-network-events/event-query"];const{name:j,category:O}=S,F={edit:e=>{const{attributes:t,className:n,setAttributes:a}=e,o=(0,h.useBlockProps)({className:I()(n,"events")});return(0,m.createElement)("div",o,(0,m.createElement)(h.InnerBlocks,{allowedBlocks:N,template:C,templateLock:"all"}))},save:()=>(0,m.createElement)(h.InnerBlocks.Content,null)};var P=JSON.parse('{"apiVersion":2,"version":"1.0.0","textdomain":"wp-action-network-events","name":"wp-action-network-events/events-tout","title":"Events Tout","category":"components","collection":"wp-action-network-events","icon":"calendar","className":"events-tout","description":"Display a tout displaying a group of events.","keywords":["events","section","tout"],"supports":{"align":false,"anchor":true,"color":{"background":false,"text":false,"gradients":false,"link":false},"customClassName":true,"defaultStylePicker":false,"__experimentalLayout":false},"attributes":{"tagName":{"type":"div"}},"variations":[],"styles":[],"example":{},"style":"file:../../build/style-index.css","editorScript":"wp-action-network-events","editorStyle":"file:../../build/index.css"}');const A=[["core/heading",{placeholder:(0,u.__)("Add Heading...","wp-action-network-events"),level:3,className:"events-tout__title"},[]],["wp-action-network-events/event-query",{className:"events-tout__list"},[]],["core/button",{className:"events-tout__button btn jade",content:(0,u.__)("See More Events","wp-action-network-events")},[]]],D=["core/heading","wp-action-network-events/event-query","core/button"];const{name:z,category:B}=P,L={edit:e=>{const{attributes:t,className:n,setAttributes:a}=e,o=(0,h.useBlockProps)({className:I()(n,"events-tout")});return(0,m.createElement)("div",o,(0,m.createElement)(h.InnerBlocks,{allowedBlocks:D,template:A,templateLock:"all"}))},save:()=>(0,m.createElement)(h.InnerBlocks.Content,null)};var q=(0,m.createElement)(v.SVG,{xmlns:"https://www.w3.org/2000/svg",viewBox:"0 0 24 24"},(0,m.createElement)(v.Path,{d:"M12 9c-.8 0-1.5.7-1.5 1.5S11.2 12 12 12s1.5-.7 1.5-1.5S12.8 9 12 9zm0-5c-3.6 0-6.5 2.8-6.5 6.2 0 .8.3 1.8.9 3.1.5 1.1 1.2 2.3 2 3.6.7 1 3 3.8 3.2 3.9l.4.5.4-.5c.2-.2 2.6-2.9 3.2-3.9.8-1.2 1.5-2.5 2-3.6.6-1.3.9-2.3.9-3.1C18.5 6.8 15.6 4 12 4zm4.3 8.7c-.5 1-1.1 2.2-1.9 3.4-.5.7-1.7 2.2-2.4 3-.7-.8-1.9-2.3-2.4-3-.8-1.2-1.4-2.3-1.9-3.3-.6-1.4-.7-2.2-.7-2.5 0-2.6 2.2-4.7 5-4.7s5 2.1 5 4.7c0 .2-.1 1-.7 2.4z"})),M=JSON.parse('{"apiVersion":2,"name":"wp-action-network-events/event-location","title":"Event Location","category":"theme","description":"Display event location in event query.","textdomain":"wp-action-network-events","icon":"location-alt","attributes":{},"usesContext":["postId","postType","queryId"],"parent":["core/post-template"],"supports":{"html":false,"color":{"gradients":false,"link":false,"text":false,"background":false},"typography":{"fontSize":false,"lineHeight":false,"__experimentalFontWeight":false}},"style":"file:../../build/style-index.css","editorScript":"wp-action-network-events","editorStyle":"file:../../build/index.css"}');const{name:H,category:R}=M,V={icon:q,edit:e=>{let{context:{postId:t,postType:n,queryId:a},attributes:o}=e;const[r]=(0,g.useEntityProp)("postType",n,"meta",t,!0),l=r._location_venue;let s=l?(0,m.createElement)("span",{className:"event-location"},l):(0,m.createElement)("span",{className:"event-location no-location"},(0,u.__)("Virtual","wp-action-network-events"));const i=(0,h.useBlockProps)();return(0,m.createElement)(m.Fragment,null,(0,m.createElement)("div",i,s))}};var Y=(0,m.createElement)(v.SVG,{viewBox:"0 0 24 24",xmlns:"http://www.w3.org/2000/svg"},(0,m.createElement)(v.Path,{d:"M12 3c-4.972 0-9 4.028-9 9s4.028 9 9 9 9-4.028 9-9-4.028-9-9-9zm0 16.259A7.256 7.256 0 014.742 12 7.256 7.256 0 0112 4.742 7.256 7.256 0 0119.259 12 7.256 7.256 0 0112 19.259zm2.243-3.79l-3.08-2.239a.438.438 0 01-.18-.352V6.92c0-.24.197-.436.436-.436h1.161c.24 0 .436.196.436.436v5.142l2.425 1.764c.195.14.235.413.093.61l-.682.939a.438.438 0 01-.61.095z"})),G=JSON.parse('{"apiVersion":2,"name":"wp-action-network-events/event-time","title":"Event Time","category":"theme","description":"Display event time in event query.","textdomain":"wp-action-network-events","attributes":{"format":{"type":"string","default":"g:i a"}},"usesContext":["postId","postType","queryId"],"parent":["core/post-template"],"supports":{"html":false,"color":{"gradients":false,"link":false,"text":false,"background":false},"typography":{"fontSize":false,"lineHeight":false,"__experimentalFontWeight":false}},"style":"file:../../build/style-index.css","editorScript":"wp-action-network-events","editorStyle":"file:../../build/index.css"}');const{name:U,category:Z}=G,J={icon:Y,edit:e=>{let{attributes:{format:t},context:{postId:n,postType:a,queryId:o},setAttributes:r}=e;const[l]=(0,g.useEntityProp)("root","site","date_format"),[s]=(0,g.useEntityProp)("postType",a,"meta",n,!0),i=s._start_date,c=(0,_.__experimentalGetSettings)(),p=(/a(?!\\)/i.test(c.formats.time.toLowerCase().replace(/\\\\/g,"").split("").reverse().join("")),Object.values(c.formats).map((e=>({key:e,name:(0,_.dateI18n)(e,i)})))),d=t||l||c.formats.date;let v=i?(0,m.createElement)("time",{dateTime:(0,_.dateI18n)("c",i)},(0,_.dateI18n)(d,i)):(0,u.__)("No Event Time","wp-action-network-events");const f=(0,h.useBlockProps)();return(0,m.createElement)(m.Fragment,null,(0,m.createElement)(h.InspectorControls,null,(0,m.createElement)(k.PanelBody,{title:(0,u.__)("Time Format Settings","wp-action-network-events")},(0,m.createElement)(k.CustomSelectControl,{hideLabelFromVision:!0,label:(0,u.__)("Time Format","wp-action-network-events"),options:p,onChange:e=>{let{selectedItem:t}=e;return r({format:t.key})},value:p.find((e=>e.key===d))}))),(0,m.createElement)("div",f,v))}};var W=(0,m.createElement)(v.SVG,{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24"},(0,m.createElement)(v.Path,{d:"M19.313 4H4.688C3.756 4 3 4.756 3 5.688v12.375c0 .931.756 1.687 1.688 1.687h14.625c.931 0 1.687-.756 1.687-1.688V5.688C21 4.756 20.244 4 19.312 4zm-.211 14.063H4.898a.21.21 0 01-.21-.211V5.898a.21.21 0 01.21-.21h14.204a.21.21 0 01.21.21v11.954a.21.21 0 01-.21.21zm-1.477-3.235v.844a.422.422 0 01-.422.422h-7.031a.422.422 0 01-.422-.422v-.844c0-.233.189-.422.422-.422h7.031c.233 0 .422.19.422.422zm0-3.375v.844a.422.422 0 01-.422.422h-7.031a.422.422 0 01-.422-.422v-.844c0-.233.189-.422.422-.422h7.031c.233 0 .422.19.422.422zm0-3.375v.844a.422.422 0 01-.422.422h-7.031a.422.422 0 01-.422-.422v-.844c0-.233.189-.422.422-.422h7.031c.233 0 .422.19.422.422zm-8.86.422a1.266 1.266 0 11-2.53 0 1.266 1.266 0 012.53 0zm0 3.375a1.266 1.266 0 11-2.53 0 1.266 1.266 0 012.53 0zm0 3.375a1.266 1.266 0 11-2.53 0 1.266 1.266 0 012.53 0z"})),$=JSON.parse('{"apiVersion":2,"name":"wp-action-network-events/event-query","title":"Event Query","category":"components","description":"Display a List of Events","textdomain":"wp-action-network-events","attributes":{"queryId":{"type":"number"},"query":{"type":"object","default":{"per_page":3,"event-tags":[],"order":"desc","orderby":"start","scope":"future"}},"taxonomy":{"type":"string","default":"event_tag"},"postType":{"type":"string","default":"an_event"},"metaKey":{"type":"string","default":"start_date"},"perPage":{"type":"number","default":3},"orderby":{"type":"string","default":"start/desc"},"eventTags":{"type":"string","default":""},"layout":{"type":"object","default":{"type":"grid"}},"scope":{"type":"string","default":"future","enum":["future","past","all"]},"dateFormat":{"type":"string","default":"l, F j, Y","enum":["l F j, Y","l, F j, Y","D, M j, Y","F j, Y","M j, Y","m/j/Y","D, M j"]},"timeFormat":{"type":"string","default":"g:ia","enum":["g:i a","g:i A","g:ia","H:i"]},"wrapperTagName":{"type":"string","default":"div"},"tagName":{"type":"string","default":"article"},"linkWrap":{"type":"boolean","default":true},"display":{"type":"object","default":{"showTags":false,"showFeaturedImage":false,"showTitle":true,"showDate":true,"showTime":true,"showEndTime":true,"showLocation":true}}},"providesContext":{"queryId":"queryId","query":"query","layout":"layout"},"supports":{"html":false,"color":{"gradients":false,"link":false,"text":false,"background":false},"typography":{"fontSize":false,"lineHeight":false,"__experimentalFontWeight":false}},"style":"file:../../build/style-index.css","editorScript":"wp-action-network-events","editorStyle":"file:../../build/index.css"}');function K(){return K=Object.assign||function(e){for(var t=1;t<arguments.length;t++){var n=arguments[t];for(var a in n)Object.prototype.hasOwnProperty.call(n,a)&&(e[a]=n[a])}return e},K.apply(this,arguments)}var Q=n(70),X=n.n(Q),ee=window.wp.compose;const te=e=>{const{attributes:t,className:n,setAttributes:a,isSelected:o}=e,{queryId:r,taxonomy:l,postType:s,eventTags:i,perPage:c,orderby:p,query:d,dateFormat:v,timeFormat:f,wrapperTagName:w,tagName:b,display:E,scope:x}=t,{showTags:S,showFeaturedImage:T,showTitle:C,showDate:N,showTime:j,showEndTime:O,showLocation:F,linkWrap:P}=E,A=(0,ee.useInstanceId)(te),[D]=(0,g.useEntityProp)("root","site","date_format"),[z]=(0,g.useEntityProp)("root","site","time_format"),B=(0,_.__experimentalGetSettings)(),L=v||D||B.formats.date,q=f||z||B.formats.time,{__unstableMarkNextChangeAsNotPersistent:M}=(0,y.useDispatch)(h.store),H=(0,y.useSelect)((e=>e("core").getEntityRecords("postType",s,d)),[d]),R=e=>{a({eventTags:e})},V=e=>{a({perPage:e})},Y=e=>{a({orderby:e})},G=e=>{a({scope:e})},U=()=>{const e=(0,y.useSelect)((e=>e("core").getEntityRecords("taxonomy",l)),[]);if(!e||!e.length)return(0,m.createElement)(k.Spinner,null);const t=e.map((e=>{let{id:t,name:n}=e;return{value:t,label:n}}));return(0,m.createElement)(m.Fragment,null,(0,m.createElement)(k.SelectControl,{label:(0,u.__)("Tag","wp-action-network-events"),options:[{value:"",label:(0,u.__)("Select a Tag","wp-action-network-events")},...t],onChange:R,value:i}))},Z=()=>(0,m.createElement)(k.RangeControl,{key:"query-controls-range-control",label:(0,u.__)("Number of Posts","wp-action-network-events"),value:c,onChange:V,min:1,max:24}),J=()=>{const e=[{value:"start/desc",label:(0,u.__)("Soonest to Latest","wp-action-network-events")},{value:"start/asc",label:(0,u.__)("Latest to Soonest","wp-action-network-events")},{value:"title/asc",label:(0,u.__)("A → Z","wp-action-network-events")},{value:"title/desc",label:(0,u.__)("Z → A","wp-action-network-events")}];return e&&e.length?(0,m.createElement)(m.Fragment,null,(0,m.createElement)(k.SelectControl,{label:(0,u.__)("Order By","wp-action-network-events"),options:e,onChange:Y,value:p})):(0,m.createElement)(k.Spinner,null)},W=()=>{const e=["future","past","all"];if(!e||!e.length)return(0,m.createElement)(k.Spinner,null);const t=e.map((e=>({value:e,label:X()(e)})));return(0,m.createElement)(m.Fragment,null,(0,m.createElement)(k.SelectControl,{label:(0,u.__)("Scope","wp-action-network-events"),options:t,onChange:G,value:x}))},$=()=>{const e=(()=>{const e=new Date;return["l F j, Y","l, F j, Y","D, M j, Y","F j, Y","M j, Y","m/j/Y","D, M j"].filter((e=>e!==B.formats.date)).concat([B.formats.date]).map((t=>({key:t,name:(0,_.dateI18n)(t,e)})))})();return(0,m.createElement)(m.Fragment,null,(0,m.createElement)(k.CustomSelectControl,{label:(0,u.__)("Date Format","wp-action-network-events"),options:e,onChange:e=>{let{selectedItem:t}=e;return a({dateFormat:t.key})},value:e.find((e=>e.key===L))}))},Q=()=>{const e=(()=>{const e=new Date;return["g:i a","g:i A","g:ia","H:i"].filter((e=>e!==B.formats.time)).concat([B.formats.time]).map((t=>({key:t,name:(0,_.dateI18n)(t,e)})))})();return(0,m.createElement)(m.Fragment,null,(0,m.createElement)(k.CustomSelectControl,{label:(0,u.__)("Time Format","wp-action-network-events"),options:e,onChange:e=>{let{selectedItem:t}=e;return a({timeFormat:t.key})},value:e.find((e=>e.key===q))}))},ne=()=>{const e=Object.keys(E);return e&&e.length?(0,m.createElement)(m.Fragment,null,e.map(((e,n)=>{const o=X()(e.replace("show",""));let r=t.display[e];return(0,m.createElement)(k.PanelRow,{key:n},(0,m.createElement)(k.ToggleControl,{label:o,help:r?(0,u.__)("Show","wp-action-network-events"):(0,u.__)("Hide","wp-action-network-events"),checked:r,onChange:t=>{a({display:{...E,[e]:t}})}}))}))):null},ae=(0,h.useBlockProps)({className:I()(n,"events__list")}),oe=e=>{var t,n,a,o,r,i,c,p,d,w,h,k;const[b,E]=(0,g.useEntityProp)("postType",s,"featured_media",e.id),x=(0,y.useSelect)((e=>!(!T||!b)&&e("core").getMedia(b,{context:"view"})),[b]),I=(0,y.useSelect)((t=>t("core").getEntityRecords("taxonomy",l,{include:e["event-tags"],context:"view"})),[]),P=(()=>{let e="event";if(I){let t=I.map((e=>`${l}-${e.slug}`));t=[e,...t],e=t.join(" ")}return e})();return(0,m.createElement)("article",{className:P},(0,m.createElement)("a",{link:e.link,rel:"bookmark"},S&&I&&(0,m.createElement)("div",{className:"event__tag"},(0,m.createElement)("a",{href:null===(t=I[0])||void 0===t?void 0:t.link,rel:"tag",dangerouslySetInnerHTML:{__html:null===(n=I[0])||void 0===n?void 0:n.name}})),T&&x&&(0,m.createElement)("picture",{className:"event__media"},(0,m.createElement)("img",{src:x.source_url,alt:x.alt_text||(0,u.__)("Featured Image","wp-action-network-events")})),C?(0,m.createElement)("h3",{className:"event__title",dangerouslySetInnerHTML:{__html:null==e||null===(a=e.title)||void 0===a?void 0:a.rendered}}):(0,m.createElement)("h3",{className:"event__title sr-only screen-reader-text",dangerouslySetInnerHTML:{__html:null==e||null===(o=e.title)||void 0===o?void 0:o.rendered}}),N&&(0,m.createElement)("div",{className:"event__date"},(0,m.createElement)("time",{dateTime:null===(r=e.meta)||void 0===r?void 0:r.start_date},(0,_.dateI18n)(v,null===(i=e.meta)||void 0===i?void 0:i.start_date))),j&&(0,m.createElement)("div",{className:"event__time"},(0,m.createElement)("time",{dateTime:null===(c=e.meta)||void 0===c?void 0:c.start_date},(0,_.dateI18n)(f,null===(p=e.meta)||void 0===p?void 0:p.start_date)),(null===(d=e.meta)||void 0===d?void 0:d.end_date)&&O&&(0,m.createElement)(m.Fragment,null,(0,m.createElement)("span",{className:"separator"}," - "),(0,m.createElement)("time",{dateTime:null===(w=e.meta)||void 0===w?void 0:w.end_date},(0,_.dateI18n)(f,null===(h=e.meta)||void 0===h?void 0:h.end_date)))),F&&(0,m.createElement)("div",{className:"event__location",dangerouslySetInnerHTML:{__html:null===(k=e.meta)||void 0===k?void 0:k.location_venue}})))},re=()=>(0,m.createElement)("div",{className:"no-posts"},(0,u.__)("No posts","wp-action-network-events"));return(0,m.useEffect)((()=>{(()=>{let e=d;const t=p.split("/");e={...e,per_page:parseInt(c),order:t[1],orderby:t[0],scope:x,"event-tags":i?[parseInt(i)]:[]},a({query:{...d,...e}})})()}),[i,c,p,x]),(0,m.useEffect)((()=>{r||(M(),a({queryId:A})),v||(M(),a({dateFormat:L})),f||(M(),a({timeFormat:q}))}),[r,A,v,z]),(0,m.createElement)(m.Fragment,null,(0,m.createElement)((()=>(0,m.createElement)(h.InspectorControls,null,(0,m.createElement)(k.PanelBody,{title:(0,u.__)("Query Options","wp-action-network-events"),initialOpen:!0},(0,m.createElement)(k.PanelRow,null,(0,m.createElement)(U,null)),(0,m.createElement)(k.PanelRow,null,(0,m.createElement)(J,null)),(0,m.createElement)(k.PanelRow,null,(0,m.createElement)(W,null)),(0,m.createElement)(k.PanelRow,null,(0,m.createElement)(Z,null))),(0,m.createElement)(k.PanelBody,{title:(0,u.__)("Display Options","wp-action-network-events"),initialOpen:!0},(0,m.createElement)(k.PanelRow,null,(0,m.createElement)($,null)),(0,m.createElement)(k.PanelRow,null,(0,m.createElement)(Q,null))),(0,m.createElement)(k.PanelBody,{title:(0,u.__)("Content Options","wp-action-network-events"),initialOpen:!0},(0,m.createElement)(ne,null)))),null),(0,m.createElement)((()=>(0,m.createElement)(h.InspectorControls,{__experimentalGroup:"advanced"},(0,m.createElement)(k.PanelBody,{title:(0,u.__)("HTML Tag Options","wp-action-network-events"),initialOpen:!0},(0,m.createElement)(k.PanelRow,null,(0,m.createElement)(k.SelectControl,{label:(0,u.__)("Wrapper HTML Element","wp-action-network-events"),options:[{label:(0,u.__)("Default (<div>)","wp-action-network-events"),value:"div"},{label:"<main>",value:"main"},{label:"<section>",value:"section"},{label:"<ul> (list)",value:"ul"}],value:w,onChange:e=>a({wrapperTagName:e})})),(0,m.createElement)(k.PanelRow,null,(0,m.createElement)(k.SelectControl,{label:(0,u.__)("Item HTML Element","wp-action-network-events"),options:[{label:(0,u.__)("Default (<article>)","wp-action-network-events"),value:"article"},{label:"<div>",value:"div"},{label:"<li>",value:"li"}],value:b,onChange:e=>a({tagName:e})}))))),null),(0,m.createElement)((()=>H?H.length?(0,m.createElement)("div",ae,H.map((e=>(0,m.createElement)(oe,K({},e,{key:e.id}))))):(0,m.createElement)(re,null):(0,m.createElement)(k.Spinner,null)),null))};var ne=te;const{name:ae,category:oe}=$,re={icon:W,edit:ne};(0,c.registerBlockCollection)("wp-action-network-events",{title:(0,u.__)("Action Network Events","wp-action-network-events"),icon:"calendar-alt"});[a,o,r,l,s,i].forEach((e=>{if(!e)return;const{name:t,settings:n}=e;(0,c.registerBlockType)(t,{...n})}))},184:function(e,t){var n;!function(){"use strict";var a={}.hasOwnProperty;function o(){for(var e=[],t=0;t<arguments.length;t++){var n=arguments[t];if(n){var r=typeof n;if("string"===r||"number"===r)e.push(n);else if(Array.isArray(n)){if(n.length){var l=o.apply(null,n);l&&e.push(l)}}else if("object"===r)if(n.toString===Object.prototype.toString)for(var s in n)a.call(n,s)&&n[s]&&e.push(s);else e.push(n.toString())}}return e.join(" ")}e.exports?(o.default=o,e.exports=o):void 0===(n=function(){return o}.apply(t,[]))||(e.exports=n)}()},70:function(e,t,n){var a,o=/[^\x00-\x2f\x3a-\x40\x5b-\x60\x7b-\x7f]+/g,r=/[\xc0-\xd6\xd8-\xf6\xf8-\xff\u0100-\u017f]/g,l="a-z\\xdf-\\xf6\\xf8-\\xff",s="A-Z\\xc0-\\xd6\\xd8-\\xde",i="\\xac\\xb1\\xd7\\xf7\\x00-\\x2f\\x3a-\\x40\\x5b-\\x60\\x7b-\\xbf\\u2000-\\u206f \\t\\x0b\\f\\xa0\\ufeff\\n\\r\\u2028\\u2029\\u1680\\u180e\\u2000\\u2001\\u2002\\u2003\\u2004\\u2005\\u2006\\u2007\\u2008\\u2009\\u200a\\u202f\\u205f\\u3000",c="["+i+"]",u="[\\u0300-\\u036f\\ufe20-\\ufe23\\u20d0-\\u20f0]",p="\\d+",d="["+l+"]",m="[^\\ud800-\\udfff"+i+p+"\\u2700-\\u27bf"+l+s+"]",v="\\ud83c[\\udffb-\\udfff]",f="[^\\ud800-\\udfff]",w="(?:\\ud83c[\\udde6-\\uddff]){2}",g="[\\ud800-\\udbff][\\udc00-\\udfff]",y="["+s+"]",_="(?:"+d+"|"+m+")",h="(?:"+y+"|"+m+")",k="(?:['’](?:d|ll|m|re|s|t|ve))?",b="(?:['’](?:D|LL|M|RE|S|T|VE))?",E="(?:"+u+"|"+v+")?",x="[\\ufe0e\\ufe0f]?",S=x+E+"(?:\\u200d(?:"+[f,w,g].join("|")+")"+x+E+")*",T="(?:"+["[\\u2700-\\u27bf]",w,g].join("|")+")"+S,I="(?:"+[f+u+"?",u,w,g,"[\\ud800-\\udfff]"].join("|")+")",C=RegExp("['’]","g"),N=RegExp(u,"g"),j=RegExp(v+"(?="+v+")|"+I+S,"g"),O=RegExp([y+"?"+d+"+"+k+"(?="+[c,y,"$"].join("|")+")",h+"+"+b+"(?="+[c,y+_,"$"].join("|")+")",y+"?"+_+"+"+k,y+"+"+b,p,T].join("|"),"g"),F=RegExp("[\\u200d\\ud800-\\udfff\\u0300-\\u036f\\ufe20-\\ufe23\\u20d0-\\u20f0\\ufe0e\\ufe0f]"),P=/[a-z][A-Z]|[A-Z]{2,}[a-z]|[0-9][a-zA-Z]|[a-zA-Z][0-9]|[^a-zA-Z0-9 ]/,A="object"==typeof n.g&&n.g&&n.g.Object===Object&&n.g,D="object"==typeof self&&self&&self.Object===Object&&self,z=A||D||Function("return this")(),B=(a={"À":"A","Á":"A","Â":"A","Ã":"A","Ä":"A","Å":"A","à":"a","á":"a","â":"a","ã":"a","ä":"a","å":"a","Ç":"C","ç":"c","Ð":"D","ð":"d","È":"E","É":"E","Ê":"E","Ë":"E","è":"e","é":"e","ê":"e","ë":"e","Ì":"I","Í":"I","Î":"I","Ï":"I","ì":"i","í":"i","î":"i","ï":"i","Ñ":"N","ñ":"n","Ò":"O","Ó":"O","Ô":"O","Õ":"O","Ö":"O","Ø":"O","ò":"o","ó":"o","ô":"o","õ":"o","ö":"o","ø":"o","Ù":"U","Ú":"U","Û":"U","Ü":"U","ù":"u","ú":"u","û":"u","ü":"u","Ý":"Y","ý":"y","ÿ":"y","Æ":"Ae","æ":"ae","Þ":"Th","þ":"th","ß":"ss","Ā":"A","Ă":"A","Ą":"A","ā":"a","ă":"a","ą":"a","Ć":"C","Ĉ":"C","Ċ":"C","Č":"C","ć":"c","ĉ":"c","ċ":"c","č":"c","Ď":"D","Đ":"D","ď":"d","đ":"d","Ē":"E","Ĕ":"E","Ė":"E","Ę":"E","Ě":"E","ē":"e","ĕ":"e","ė":"e","ę":"e","ě":"e","Ĝ":"G","Ğ":"G","Ġ":"G","Ģ":"G","ĝ":"g","ğ":"g","ġ":"g","ģ":"g","Ĥ":"H","Ħ":"H","ĥ":"h","ħ":"h","Ĩ":"I","Ī":"I","Ĭ":"I","Į":"I","İ":"I","ĩ":"i","ī":"i","ĭ":"i","į":"i","ı":"i","Ĵ":"J","ĵ":"j","Ķ":"K","ķ":"k","ĸ":"k","Ĺ":"L","Ļ":"L","Ľ":"L","Ŀ":"L","Ł":"L","ĺ":"l","ļ":"l","ľ":"l","ŀ":"l","ł":"l","Ń":"N","Ņ":"N","Ň":"N","Ŋ":"N","ń":"n","ņ":"n","ň":"n","ŋ":"n","Ō":"O","Ŏ":"O","Ő":"O","ō":"o","ŏ":"o","ő":"o","Ŕ":"R","Ŗ":"R","Ř":"R","ŕ":"r","ŗ":"r","ř":"r","Ś":"S","Ŝ":"S","Ş":"S","Š":"S","ś":"s","ŝ":"s","ş":"s","š":"s","Ţ":"T","Ť":"T","Ŧ":"T","ţ":"t","ť":"t","ŧ":"t","Ũ":"U","Ū":"U","Ŭ":"U","Ů":"U","Ű":"U","Ų":"U","ũ":"u","ū":"u","ŭ":"u","ů":"u","ű":"u","ų":"u","Ŵ":"W","ŵ":"w","Ŷ":"Y","ŷ":"y","Ÿ":"Y","Ź":"Z","Ż":"Z","Ž":"Z","ź":"z","ż":"z","ž":"z","Ĳ":"IJ","ĳ":"ij","Œ":"Oe","œ":"oe","ŉ":"'n","ſ":"ss"},function(e){return null==a?void 0:a[e]});function L(e){return F.test(e)}var q=Object.prototype.toString,M=z.Symbol,H=M?M.prototype:void 0,R=H?H.toString:void 0;function V(e){return null==e?"":function(e){if("string"==typeof e)return e;if(function(e){return"symbol"==typeof e||function(e){return!!e&&"object"==typeof e}(e)&&"[object Symbol]"==q.call(e)}(e))return R?R.call(e):"";var t=e+"";return"0"==t&&1/e==-1/0?"-0":t}(e)}var Y,G=(Y=function(e,t,n){return e+(n?" ":"")+U(t)},function(e){return function(e,t,n,a){for(var o=-1,r=e?e.length:0;++o<r;)n=t(n,e[o],o,e);return n}(function(e,t,n){return e=V(e),void 0===(t=t)?function(e){return P.test(e)}(e)?function(e){return e.match(O)||[]}(e):function(e){return e.match(o)||[]}(e):e.match(t)||[]}(function(e){return(e=V(e))&&e.replace(r,B).replace(N,"")}(e).replace(C,"")),Y,"")}),U=("toUpperCase",function(e){var t,n,a,o,r=L(e=V(e))?function(e){return L(e)?function(e){return e.match(j)||[]}(e):function(e){return e.split("")}(e)}(e):void 0,l=r?r[0]:e.charAt(0),s=r?(t=r,n=1,o=t.length,a=void 0===a?o:a,!n&&a>=o?t:function(e,t,n){var a=-1,o=e.length;t<0&&(t=-t>o?0:o+t),(n=n>o?o:n)<0&&(n+=o),o=t>n?0:n-t>>>0,t>>>=0;for(var r=Array(o);++a<o;)r[a]=e[a+t];return r}(t,n,a)).join(""):e.slice(1);return l.toUpperCase()+s});e.exports=G}},n={};function a(e){var o=n[e];if(void 0!==o)return o.exports;var r=n[e]={exports:{}};return t[e](r,r.exports,a),r.exports}a.m=t,e=[],a.O=function(t,n,o,r){if(!n){var l=1/0;for(u=0;u<e.length;u++){n=e[u][0],o=e[u][1],r=e[u][2];for(var s=!0,i=0;i<n.length;i++)(!1&r||l>=r)&&Object.keys(a.O).every((function(e){return a.O[e](n[i])}))?n.splice(i--,1):(s=!1,r<l&&(l=r));if(s){e.splice(u--,1);var c=o();void 0!==c&&(t=c)}}return t}r=r||0;for(var u=e.length;u>0&&e[u-1][2]>r;u--)e[u]=e[u-1];e[u]=[n,o,r]},a.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return a.d(t,{a:t}),t},a.d=function(e,t){for(var n in t)a.o(t,n)&&!a.o(e,n)&&Object.defineProperty(e,n,{enumerable:!0,get:t[n]})},a.g=function(){if("object"==typeof globalThis)return globalThis;try{return this||new Function("return this")()}catch(e){if("object"==typeof window)return window}}(),a.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},a.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},function(){var e={826:0,46:0};a.O.j=function(t){return 0===e[t]};var t=function(t,n){var o,r,l=n[0],s=n[1],i=n[2],c=0;if(l.some((function(t){return 0!==e[t]}))){for(o in s)a.o(s,o)&&(a.m[o]=s[o]);if(i)var u=i(a)}for(t&&t(n);c<l.length;c++)r=l[c],a.o(e,r)&&e[r]&&e[r][0](),e[l[c]]=0;return a.O(u)},n=self.webpackChunkexample_blocks=self.webpackChunkexample_blocks||[];n.forEach(t.bind(null,0)),n.push=t.bind(null,n.push.bind(n))}();var o=a.O(void 0,[46],(function(){return a(115)}));o=a.O(o)}();