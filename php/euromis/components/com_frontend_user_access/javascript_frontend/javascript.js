var typeTranslation = {};
var types;
	
	// Hide certain types of content
	// names argument can be either a String or an Array, values should match the types in the type object or those in typeTranslation object
	function hideType( names ) {
		if ( names.constructor == String ) {
			var name = typeTranslation[names] || names;
			names = [ name ];
		}
		else if ( names.constructor == Array ) {
			var sObj = {};
			var sArr = [];
			for ( var i = 0; i < names.length; i++ ) {
				var sName = typeTranslation[names[i]] || names[i];
				if ( !sObj[sName] ) {
					sArr.push(sName);
					sObj[sName] = true;
				};
			};
			names = sArr;
			sObj = sArr = null;
		}
		else {
			return;
		};
		
		for ( var i = 0; i < names.length; i++ ) {
			var type = types[names[i]];
			var elems = getTypeElements(type);
			if ( !(elems && elems.length) ) return;
			
			//hideElements(elems);
			removeElements(elems);
		}
	};
	
	// Get elements related to content type
	function getTypeElements( type ) {
		var hook = type.hook;
		var main = type.main;
		//if ( !(hook && hook.tagName && hook.className && main && main.tagName && main.className) ) return;
		if ( !(hook && hook.tagName && hook.className && main && main.tagName && main.className) ) return;
		
		var elems = [];
		var hookElems = document.getElementsByTagName(hook.tagName);
		for ( var i = 0; i < hookElems.length; i++ ) {
			var hookElem = hookElems[i];
			var mainElem = getAncestor(hookElem, main.tagName, main.className, hook.maxLevels);
			if ( !mainElem ) continue;
			
			elems.push(mainElem);
			if ( type.prev ) elems = elems.concat(getSiblings(mainElem, type.prev, "previous"));
			if ( type.next ) elems = elems.concat(getSiblings(mainElem, type.next, "next"));
		};
		return elems;
	};
	
	// Get siblings belonging to content type
	function getSiblings( elem, sibl, dir ) {
		var siblings = [];
		for ( var i = 0; i < sibl.length; i++ ) {
			do {
				elem = elem[dir + "Sibling"];
			} while ( elem && elem.nodeType != 1 );
			
			var sibling = sibl[i];
			var cName = sibling.className;
			var tName = sibling.tagName.toLowerCase();
			if ( elem && !(cName && !hasClass(elem, cName)) && !(tName && elem.tagName.toLowerCase() != tName)) siblings.push(elem);	// className and tagName should pass, but only if they were given
		};
		return siblings;
	};	

	// Remove elements from DOM
	function removeElements( elems ) {
		for ( var i = 0; i < elems.length; i++ ) {
			var node = elems[i];
			node.parentNode.removeChild(node);
		};
	};

	// Check whether element has a certain className
	function hasClass( elem, name ) {
		if ( !name && elem.className != "") return true;			// if no className has been specified any className will do | -> Boolean
		var regExp = new RegExp( "(^|\\s)" + name + "(\\s|$)" );	// allows for multiple class names
		if ( regExp.test( elem.className )) return true;			// -> Boolean
		return false;															// -> Boolean
	};
	
	// Find ancestor based on tagName or className or both, optionally limit the search to a certain number of levels
	function getAncestor(node, tagName, className, levels) {					// levels is an optional argument and either tagName or className may be set to "" or null, never both
		var parent = node;
		tagName = tagName.toLowerCase();
		var level = levels || 1;
		do {
			parent = parent.parentNode;
			if ( !parent || parent.nodeName == "HTML" ) return false;	// there is no parent or parent is <html>
			if ( !(tagName && parent.tagName.toLowerCase() != tagName) && !(className && !hasClass(parent, className)) ) return parent; // return parent if property matches value
			
			if (levels) level--;
		} while (parent.parentNode && parent.parentNode.nodeName != "HTML" && level > 0);
		return false;
	};
	
	/* --- check if node has className (modified) --- */
	function hasClass_mod(node, className, startsWith) {   // startsWith is an optional argument
		var nodeClass = node.className;
		if (!className && nodeClass != "") return true;            // if no className is specified any className will do
		if (className && nodeClass.indexOf(className) > -1) {    // match, but not exact
			var nodeClasses = nodeClass.split(/\s+/);            // seperate class names (devided by one or more whitespaces)
			for (c=0; c<nodeClasses.length; c++) {
				 if (startsWith || startsWith == null) {
					if (nodeClasses[c] == className) return true;                  // exact match
				 } else {
					if (nodeClasses[c].indexOf(className) == 0) return true;   // classname starts with given name
				 }
			}
		}
		return false;
	}
	
	/* --- get first ancestor that matches the property (modified) --- */
	function getAncestor_mod(node, property, value, levels) {    // levels is an optional argument
		var parent = node;
		var level = (levels) ? levels : 1;
		do {
			parent = parent.parentNode;
			if (!parent || parent.nodeName == "HTML") return false;    // there is no parent or parent is <html>
		   
			if ((parent[property] == value) ? true : hasClass_mod(parent, value, false)) return parent; // return parent if property matches value
			   
			if (levels) level--;
		} while (parent.parentNode && parent.parentNode.nodeName != "HTML" && level > 0);
		return false;
	}

	function fua_hide_stuff(){
		var brs = document.getElementsByTagName("br");
		for (var i = 0; i < brs.length; i++) {
			var br = brs[i];
			if (hasClass_mod(br, "make_me_go_away")){   
			   var module = getAncestor_mod(br, "make_me_go_away", "module");
			   if (module) module.style.display = "none";
			   //var module = getAncestor_mod(br, "make_me_go_away", "art");
			   //if (module) module.style.display = "none";
			}
			if (hasClass_mod(br, "fua_article_hide")){
				hideType(['pattern']);
			}
		}		
	}	
	
	if(window.addEventListener)window.addEventListener("load",fua_hide_stuff,false);else if(window.attachEvent)window.attachEvent("onload",fua_hide_stuff);