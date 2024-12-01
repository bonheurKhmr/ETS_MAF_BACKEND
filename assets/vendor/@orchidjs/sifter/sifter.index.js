/**
 * Bundled by jsDelivr using Rollup v2.79.1 and Terser v5.19.2.
 * Original file: /npm/@orchidjs/sifter@1.1.0/dist/esm/sifter.js
 *
 * Do NOT use SRI with dynamically generated files! More information: https://www.jsdelivr.com/using-sri-with-dynamic-files
 */
import{asciifold as t,escape_regex as e,getPattern as r}from"@orchidjs/unicode-variants";export{getPattern}from"@orchidjs/unicode-variants";const n=(t,e)=>{if(t)return t[e]},i=(t,e)=>{if(t){for(var r,n=e.split(".");(r=n.shift())&&(t=t[r]););return t}},o=(t,e,r)=>{var n,i;return t?(t+="",null==e.regex||-1===(i=t.search(e.regex))?0:(n=e.string.length/t.length,0===i&&(n+=.5),n*r)):0},s=(t,e)=>{var r=t[e];if("function"==typeof r)return r;r&&!Array.isArray(r)&&(t[e]=[r])},c=(t,e)=>{if(Array.isArray(t))t.forEach(e);else for(var r in t)t.hasOwnProperty(r)&&e(t[r],r)},u=(e,r)=>"number"==typeof e&&"number"==typeof r?e>r?1:e<r?-1:0:(e=t(e+"").toLowerCase())>(r=t(r+"").toLowerCase())?1:r>e?-1:0;class f{items;settings;constructor(t,e){this.items=t,this.settings=e||{diacritics:!0}}tokenize(t,n,i){if(!t||!t.length)return[];const o=[],s=t.split(/\s+/);var c;return i&&(c=new RegExp("^("+Object.keys(i).map(e).join("|")+"):(.*)$")),s.forEach((t=>{let i,s=null,u=null;c&&(i=t.match(c))&&(s=i[1],t=i[2]),t.length>0&&(u=this.settings.diacritics?r(t)||null:e(t),u&&n&&(u="\\b"+u)),o.push({string:t,regex:u?new RegExp(u,"iu"):null,field:s})})),o}getScoreFunction(t,e){var r=this.prepareSearch(t,e);return this._getScoreFunction(r)}_getScoreFunction(t){const e=t.tokens,r=e.length;if(!r)return function(){return 0};const n=t.options.fields,i=t.weights,s=n.length,u=t.getAttrFn;if(!s)return function(){return 1};const f=1===s?function(t,e){const r=n[0].field;return o(u(e,r),t,i[r]||1)}:function(t,e){var r=0;if(t.field){const n=u(e,t.field);!t.regex&&n?r+=1/s:r+=o(n,t,1)}else c(i,((n,i)=>{r+=o(u(e,i),t,n)}));return r/s};return 1===r?function(t){return f(e[0],t)}:"and"===t.options.conjunction?function(t){var n,i=0;for(let r of e){if((n=f(r,t))<=0)return 0;i+=n}return i/r}:function(t){var n=0;return c(e,(e=>{n+=f(e,t)})),n/r}}getSortFunction(t,e){var r=this.prepareSearch(t,e);return this._getSortFunction(r)}_getSortFunction(t){var e,r=[];const n=this,i=t.options,o=!t.query&&i.sort_empty?i.sort_empty:i.sort;if("function"==typeof o)return o.bind(this);const s=function(e,r){return"$score"===e?r.score:t.getAttrFn(n.items[r.id],e)};if(o)for(let e of o)(t.query||"$score"!==e.field)&&r.push(e);if(t.query){e=!0;for(let t of r)if("$score"===t.field){e=!1;break}e&&r.unshift({field:"$score",direction:"desc"})}else r=r.filter((t=>"$score"!==t.field));return r.length?function(t,e){var n,i;for(let o of r){if(i=o.field,n=("desc"===o.direction?-1:1)*u(s(i,t),s(i,e)))return n}return 0}:null}prepareSearch(t,e){const r={};var o=Object.assign({},e);if(s(o,"sort"),s(o,"sort_empty"),o.fields){s(o,"fields");const t=[];o.fields.forEach((e=>{"string"==typeof e&&(e={field:e,weight:1}),t.push(e),r[e.field]="weight"in e?e.weight:1})),o.fields=t}return{options:o,query:t.toLowerCase().trim(),tokens:this.tokenize(t,o.respect_word_boundaries,r),total:0,items:[],weights:r,getAttrFn:o.nesting?i:n}}search(t,e){var r,n,i=this;n=this.prepareSearch(t,e),e=n.options,t=n.query;const o=e.score||i._getScoreFunction(n);t.length?c(i.items,((t,i)=>{r=o(t),(!1===e.filter||r>0)&&n.items.push({score:r,id:i})})):c(i.items,((t,e)=>{n.items.push({score:1,id:e})}));const s=i._getSortFunction(n);return s&&n.items.sort(s),n.total=n.items.length,"number"==typeof e.limit&&(n.items=n.items.slice(0,e.limit)),n}}export{f as Sifter,u as cmp,n as getAttr,i as getAttrNesting,c as iterate,s as propToArray,o as scoreValue};export default null;
