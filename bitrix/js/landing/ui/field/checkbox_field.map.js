{"version":3,"sources":["checkbox_field.js"],"names":["BX","namespace","addClass","Landing","Utils","isArray","isPlainObject","isFunction","create","random","escapeHtml","append","slice","encodeDataValue","decodeDataValue","isNumber","isBoolean","data","clone","UI","Field","Checkbox","options","BaseField","apply","this","arguments","layout","onChangeHandler","onChange","items","value","depth","compact","map","filter","item","checked","content","forEach","addItem","prototype","constructor","__proto__","itemOptions","itemId","props","className","children","attrs","id","type","find","itemVal","undefined","events","change","onItemChange","bind","for","html","name","input","onValueChangeHandler","isChanged","sort","getValue","JSON","stringify","setValue","element","querySelector","currentValue"],"mappings":"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","file":""}