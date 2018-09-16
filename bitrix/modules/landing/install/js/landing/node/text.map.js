{"version":3,"sources":["text.js"],"names":["BX","namespace","escapeText","Landing","Utils","headerTagMatcher","Matchers","headerTag","changeTagName","textToPlaceholders","Block","Node","Text","options","apply","this","arguments","onClick","bind","onPaste","onDrop","onInput","onMousedown","onMouseup","node","addEventListener","document","currentNode","prototype","__proto__","superClass","constructor","onAllowInlineEdit","setAttribute","message","onChange","preventAdjustPosition","preventHistory","call","UI","Panel","EditorPanel","getInstance","adjustPosition","History","push","Entry","block","top","storage","getByChildNode","id","selector","command","undo","lastValue","redo","getValue","event","clearTimeout","inputTimeout","key","keyCode","which","window","navigator","userAgent","match","ctrlKey","metaKey","setTimeout","onEscapePress","isEditable","hide","disableEdit","preventDefault","clipboardData","getData","execCommand","onDocumentClick","fromNode","manifest","allowInlineEdit","Main","isControlsEnabled","stopPropagation","enableEdit","Tool","ColorPicker","hideAll","Button","FontAction","requestAnimationFrame","target","nodeName","parentElement","range","createRange","selectNode","getSelection","removeAllRanges","addRange","isContentEditable","StylePanel","isShown","buttons","getDesignButton","isHeader","getChangeTagButton","changeHandler","onChangeTag","show","contentEditable","focus","designButton","Design","html","attrs","title","onDesignShow","code","isAllowInlineEdit","getField","field","Field","name","content","innerHTML","changeTagButton","setValue","value","preventSave","isSavePrevented","util","htmlspecialcharsback","test","ChangeTag","insertAfter","activateItem","data","changeOptionsHandler"],"mappings":"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","file":""}