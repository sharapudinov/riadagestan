window.RSMediaPostComments = function(params) {
  this.params = params;
  this.container = BX(params.blockId);
  this.form = BX(params.formId);
  this.errorBlock = BX(params.commentErrorId);
  this.messageBlock = BX(params.commentMessageId);
  this.errorMessageBlock = BX(params.commentErrorMessageId);
  this.comments = BX(params.commentsId);

  this.consent = false;

  this.init();
}

RSMediaPostComments.prototype.init = function() {
  var commentItems;

  this.getCaptcha();

  BX.bind(this.form, 'submit', BX.delegate(this.formSubmit, this));

  commentItems = this.comments.querySelectorAll('[data-comment]');

  if (commentItems.length > 0) {
    this.comments.style.display = 'block';
  }

  for (var i = 0; i < commentItems.length; i++) {
    this.listenItemEvents(commentItems[i]);
  }
}

RSMediaPostComments.prototype.listenItemEvents = function(node) {
    BX.bind(node.querySelector('[data-delete-comment]'), 'click', BX.delegate(this.deleteComment, this));
    BX.bind(node.querySelector('[data-toggle-comment]'), 'click', BX.delegate(this.toggleComment, this));
}

RSMediaPostComments.prototype.getCaptcha = function() {
  if (this.params.useCaptcha && !this.params.userId) {
    BX.ajax.getCaptcha(function(data) {
      BX("captcha_word").value = "";
      BX("captcha_code").value = data["captcha_sid"];
      BX("captcha").src = '/bitrix/tools/captcha.php?captcha_code=' + data["captcha_sid"];
      BX("captcha").style.display = "";
    });
  }
}

RSMediaPostComments.prototype.formSubmit = function(e) {
  e.preventDefault();

  BX.closeWait(); // remove default loader

  if (this.userId == '' && params.useConsent) {
    this.checkConsent();
  } else {
    this.send();
  }
}

RSMediaPostComments.prototype.checkConsent = function(e) {
  if (this.consent) {
    this.send();
  } else {
    var control = BX.UserConsent.load(this.form);

    BX.addCustomEvent(
      control,
      BX.UserConsent.events.save,
      BX.proxy(function() {
        this.consent = true;
        this.submit();
      }, this)
    );
    BX.addCustomEvent(
      control,
      BX.UserConsent.events.refused,
      BX.proxy(function() {
        this.consent = false;
      }, this)
    );
  }
}

RSMediaPostComments.prototype.clearMessages = function() {
  this.errorBlock.innerHTML = '';
  this.messageBlock.innerHTML = '';
  this.errorMessageBlock.innerHTML = '';
}

RSMediaPostComments.prototype.send = function() {
  var postData = this.getFormData();

  postData['REVIEW_TEXT'] = BX.util.jsencode(postData.comment);
  postData['NOREDIRECT'] = "Y";
  postData['MODE'] = "RECORD";
  postData['AJAX_POST'] = "Y";
  postData['ENTITY_XML_ID'] = this.params.entity.xmlId;
  postData['ENTITY_TYPE'] = this.params.entity.type;
  postData['ENTITY'] = this.params.entity.id;
  postData['comment_post_id'] = this.params.entity.id;

  postData['decode'] = "Y";

  if (this.targetId) {
    postData['id'] = [this.params.entityId, this.targetId];
  } else {
    postData['id'] = [this.params.entityId, 0];
  }

  postData['edit_id'] = 0;
  postData['parentId'] = 0;

  postData['COMMENT_EXEMPLAR_ID'] = BX.util.getRandomString(20);

  postData['SITE_ID'] = BX.message("SITE_ID");
  postData['LANGUAGE_ID'] = BX.message("LANGUAGE_ID");

  BX.ajax({
    'method': 'POST',
    'url': this.form.action,
    'data': postData,
    'dataType': 'html',
    'processData': false,
    onsuccess: BX.proxy(function(html) {
      var resultDiv = document.createElement('div'),
        fatalErrors, errors, messages, errorMessages, comments;

      resultDiv.innerHTML = html;

      fatalErrors = resultDiv.querySelector('#' + this.params.fatalErrorId);
      if (fatalErrors) {
        this.container.innerHTML = resultDiv;
      } else {
        error = resultDiv.querySelector('#' + this.params.commentErrorId);
        messages = resultDiv.querySelector('#' + this.params.commentMessageId);
        errorMessages = resultDiv.querySelector('#' + this.params.commentErrorMessageId);
        comments = resultDiv.querySelector('#' + this.params.commentsId);

        if (error) {
          this.errorBlock.innerHTML = error.innerHTML;
        }

        if (messages) {
          this.messageBlock.innerHTML = messages.innerHTML;
        }

        if (errorMessages) {
          this.errorMessageBlock.innerHTML = errorMessages.innerHTML;
        }

        if (comments) {
          while (comments.children.length > 0) {
            this.listenItemEvents(comments.children[0]);
            this.comments.appendChild(comments.children[0]);
            this.comments.style.display = 'block';
          }
        }

        this.form['POST_MESSAGE'].value = '';
        this.getCaptcha();
      }

    }, this)
  });
}

RSMediaPostComments.prototype.getCommentNodeById = function(commentId, context) {
    return (
        !context || context === document ?
          document.getElementById('comment_' + this.params.id + '_' + commentId) :
          context.querySelector('#comment_' + this.params.id + '_' + commentId)
    )
}

RSMediaPostComments.prototype.deleteComment = function(event) {
  var target, url, commentId;

  event.preventDefault();

  target = event.target;
  url = event.target.href;
  commentId = target.getAttribute('data-delete-comment');

  if (url) {
    BX.ajax.get(url, BX.proxy(function(html) {
      var resultDiv, comment;
      resultDiv = document.createElement('div');

      resultDiv.innerHTML = html;

      comment = this.getCommentNodeById(commentId);

      if (resultDiv.querySelector("#" + this.params.commentMessageId)) {
        comment.innerHTML = resultDiv.querySelector("#" + this.params.commentMessageId).innerHTML;
      }

    }, this));
  }
}

RSMediaPostComments.prototype.toggleComment = function(event) {
  var target, url, commentId, commentNode;

  event.preventDefault();

  target = event.target;
  url = event.target.href;
  commentId = target.getAttribute('data-toggle-comment');

  if (url) {
    BX.ajax.get(url, BX.proxy(function (html) {
      var commentNode, resultNode, newComment;

      resultNode = document.createElement('div');
      resultNode.innerHTML = html;

      commentNode = this.getCommentNodeById(commentId);
      newComment = this.getCommentNodeById(commentId, resultNode);

      if (commentNode && newComment) {
        this.listenItemEvents(newComment);
        commentNode.parentNode.replaceChild(newComment, commentNode);
      }
    }, this));
  }
}

RSMediaPostComments.prototype.getFormData = function(data) {
  var form = this.form;
  var data = [];

  if (!!form) {
    var
      i,
      _data = [],
      n = form.elements.length;

    for (i = 0; i < n; i++) {
      var el = form.elements[i];
      if (el.disabled)
        continue;
      switch (el.type.toLowerCase()) {
        case 'text':
        case 'textarea':
        case 'password':
        case 'hidden':
        case 'select-one':
          _data.push({
            name: el.name,
            value: el.value
          });
          break;
        case 'radio':
        case 'checkbox':
          if (el.checked)
            _data.push({
              name: el.name,
              value: el.value
            });
          break;
        case 'select-multiple':
          for (var j = 0; j < el.options.length; j++) {
            if (el.options[j].selected)
              _data.push({
                name: el.name,
                value: el.options[j].value
              });
          }
          break;
        default:
          break;
      }
    }

    var current = data;
    i = 0;

    while (i < _data.length) {
      var p = _data[i].name.indexOf('[');
      if (p == -1) {
        current[_data[i].name] = _data[i].value;
        current = data;
        i++;
      } else {
        var name = _data[i].name.substring(0, p);
        var rest = _data[i].name.substring(p + 1);
        if (!current[name])
          current[name] = [];

        var pp = rest.indexOf(']');
        if (pp == -1) {
          current = data;
          i++;
        } else if (pp === 0) {
          //No index specified - so take the next integer
          current = current[name];
          _data[i].name = '' + current.length;
        } else {
          //Now index name becomes and name and we go deeper into the array
          current = current[name];
          _data[i].name = rest.substring(0, pp) + rest.substring(pp + 1);
        }
      }
    }
  }
  return data;
}
