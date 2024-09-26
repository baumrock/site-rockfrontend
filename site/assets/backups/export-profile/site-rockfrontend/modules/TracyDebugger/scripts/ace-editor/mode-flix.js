define("ace/mode/flix_highlight_rules",["require","exports","module","ace/lib/oop","ace/mode/text_highlight_rules"],function(e,t,n){"use strict";var r=e("../lib/oop"),i=e("./text_highlight_rules").TextHighlightRules,s=function(){var e="use|checked_cast|checked_ecast|unchecked_cast|masked_cast|as|discard|from|into|inject|project|solve|query|where|select|force|import|region|red|deref",t="choose|debug|do|for|forA|forM|foreach|yield|if|else|case|match|typematch|try|catch|resume|spawn|par|branch|jumpto",n="not|and|or|fix",r="eff|def|law|enum|case|type|alias|class|instance|mod|let",i="with|without|opaque|lazy|lawful|pub|override|sealed|static",s="Unit|Bool|Char|Float32|Float64|Int8|Int16|Int32|Int64|BigInt|String",o=this.createKeywordMapper({keyword:e,"keyword.control":t,"keyword.operator":n,"storage.type":r,"storage.modifier":i,"support.type":s},"identifier");this.$rules={start:[{token:"comment.line",regex:"\\/\\/.*$"},{token:"comment.block",regex:"\\/\\*",next:"comment"},{token:"string",regex:'"',next:"string"},{token:"string.regexp",regex:'regex"',next:"regex"},{token:"constant.character",regex:"'",next:"char"},{token:"constant.numeric",regex:"0x[a-fA-F0-9](_*[a-fA-F0-9])*(i8|i16|i32|i64|ii)?\\b"},{token:"constant.numeric",regex:"[0-9](_*[0-9])*\\.[0-9](_*[0-9])*(f32|f64)?\\b"},{token:"constant.numeric",regex:"[0-9](_*[0-9])*(i8|i16|i32|i64|ii)?\\b"},{token:"constant.language.boolean",regex:"(true|false)\\b"},{token:"constant.language",regex:"null\\b"},{token:"keyword.operator",regex:"\\->|~>|<\\-|=>"},{token:"storage.modifier",regex:"@(Deprecated|Experimental|Internal|ParallelWhenPure|Parallel|LazyWhenPure|Lazy|Skip|Test)\\b"},{token:"keyword",regex:"(\\?\\?\\?|\\?[a-zA-Z0-9]+)"},{token:o,regex:"[a-zA-Z_$][a-zA-Z0-9_$]*\\b"},{token:"paren.lparen",regex:"[[({]"},{token:"paren.rparen",regex:"[\\])}]"},{token:"text",regex:"\\s+"}],comment:[{token:"comment.block",regex:"\\*\\/",next:"start"},{defaultToken:"comment.block"}],string:[{token:"constant.character.escape",regex:"\\\\(u[0-9a-fA-F]{4})"},{token:"constant.character.escape",regex:"\\\\."},{token:"string",regex:'"',next:"start"},{token:"string",regex:'[^"\\\\]+'}],regex:[{token:"constant.character.escape",regex:"\\\\(u[0-9a-fA-F]{4})"},{token:"constant.character.escape",regex:"\\\\."},{token:"string.regexp",regex:'"',next:"start"},{token:"string.regexp",regex:'[^"\\\\]+'}],"char":[{token:"constant.character.escape",regex:"\\\\(u[0-9a-fA-F]{4})"},{token:"constant.character.escape",regex:"\\\\."},{token:"constant.character",regex:"'",next:"start"},{token:"constant.character",regex:"[^'\\\\]+"}]}};r.inherits(s,i),t.FlixHighlightRules=s}),define("ace/mode/flix",["require","exports","module","ace/lib/oop","ace/mode/text","ace/mode/flix_highlight_rules"],function(e,t,n){"use strict";var r=e("../lib/oop"),i=e("./text").Mode,s=e("./flix_highlight_rules").FlixHighlightRules,o=function(){this.HighlightRules=s};r.inherits(o,i),function(){this.$id="ace/mode/flix"}.call(o.prototype),t.Mode=o});                (function() {
                    window.require(["ace/mode/flix"], function(m) {
                        if (typeof module == "object" && typeof exports == "object" && module) {
                            module.exports = m;
                        }
                    });
                })();
            