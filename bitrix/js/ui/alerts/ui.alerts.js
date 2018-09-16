(function() {

	'use strict';

	BX.namespace('BX.UI.Alert');

	BX.UI.Alert = function(options)
	{
		this.options = options || {};

		this.targetNode = this.options.targetNode;
		this.alertWrap = null;
		this.text = null;
		this.icon = null;
		this.textNode = null;
		this.closeBtn = false;
		this.closeNode = null;
		this.animated = false;
		this.color = BX.UI.Alert.Color.PRIMARY;
		this.size = BX.UI.Alert.Size.MEDIUM;

		this.setText(options.text);

		this.setAnimation(options.animated);
		this.setInline(options.inline);
		this.setTextCenter(options.textCenter);
		this.setIcon(options.icon);
		this.setColor(options.color);
		this.setSize(options.size);
	};

	/**
	 *
	 * @enum {string}
	 */
	BX.UI.Alert.Color = {
		DEFAULT: "ui-alert-default",
		DANGER: "ui-alert-danger",
		SUCCESS: "ui-alert-success",
		PRIMARY: "ui-alert-primary",
		WARNING: "ui-alert-warning"
	};

	/**
	 *
	 * @enum {string}
	 */
	BX.UI.Alert.Size = {
		MEDIUM: "ui-alert-md",
		SMALL: "ui-alert-xs"
	};

	/**
	 *
	 * @enum {string}
	 */
	BX.UI.Alert.Icon = {
		WARNING: "ui-alert-icon-warning",
		DANGER: "ui-alert-icon-danger",
		INFO: "ui-alert-icon-info"
	};

	BX.UI.Alert.prototype =
	{
		//region Parameters
		setColor: function(color)
		{
			if (BX.type.isNotEmptyString(color))
			{
				BX.removeClass(this.getAlertWrap(), this.color);
				this.color = color;
				BX.addClass(this.getAlertWrap(), this.color);
			}
		},

		setSize: function(size)
		{
			if (BX.type.isNotEmptyString(size))
			{
				BX.removeClass(this.getAlertWrap(), this.size);
				this.size = size;
				BX.addClass(this.getAlertWrap(), this.size);
			}
		},

		setText: function(text)
		{
			if (BX.type.isNotEmptyString(text))
			{
				this.text = text;
			}
		},

		setIcon: function(icon)
		{
			if (BX.type.isNotEmptyString(icon))
			{
				BX.removeClass(this.getAlertWrap(), this.icon);
				this.icon = icon;
				BX.addClass(this.getAlertWrap(), this.icon);
			}
		},

		setTextCenter: function(boolean)
		{
			if (BX.type.isBoolean(boolean))
			{
				this.textCenter = boolean;
				if (this.textCenter === true)
				{
					BX.addClass(this.getAlertWrap(), "ui-alert-text-center");
				}
				else
				{
					BX.removeClass(this.getAlertWrap(), "ui-alert-text-center");
				}
			}
		},

		setInline: function(boolean)
		{
			if (BX.type.isBoolean(boolean))
			{
				this.inline = boolean;
				if (this.inline === true)
				{
					BX.addClass(this.getAlertWrap(), "ui-alert-inline");
				}
				else
				{
					BX.removeClass(this.getAlertWrap(), "ui-alert-inline");
				}
			}
		},

		getText: function()
		{
			return this.text;
		},

		getTextNode: function()
		{
			if (this.textNode === null)
			{
				this.textNode = BX.create("div", {
					props: { className: "ui-alert-message" },
					html: this.getText()
				})
			}

			return this.textNode;
		},

		//endregion

		// region Close
		getCloseBtn: function()
		{
			if ((this.closeNode === null) && (this.options.closeBtn === true))
			{
				this.closeNode = BX.create("span", {
					props: { className: "ui-alert-close-btn" },
					events: {
						click: this.handleCloseBtnClick.bind(this)
					}
				})
			}

			return this.closeNode;
		},

		handleCloseBtnClick: function()
		{
			if (this.animated === true)
			{
				this.animateClosing();
			}
			else
			{
				BX.remove(this.alertWrap);
			}
		},

		animateClosing: function()
		{
			this.alertWrap.style.overflow = "hidden";

			var alertWrapPos = BX.pos(this.alertWrap);
			this.alertWrap.style.height = alertWrapPos.height + "px";

			setTimeout(
				function() {
					this.alertWrap.style.height = 0;
					this.alertWrap.style.paddingTop = 0;
					this.alertWrap.style.paddingBottom = 0;
					this.alertWrap.style.marginBottom = 0;
					this.alertWrap.style.opacity = 0;
				}.bind(this),
				10
			);

			setTimeout(
				function() {
					BX.remove(this.alertWrap);
				}.bind(this),
				260
			);
		},
		//endregion

		// region Animations

		setAnimation: function(boolean)
		{
			if (BX.type.isBoolean(boolean))
			{
				this.animated = boolean;
			}
		},

		//endregion

		getAlertWrap: function()
		{
			if (this.alertWrap !== null)
			{
				return this.alertWrap;
			}

			// region if(animated)
			if (this.animated === true)
			{
				var maxHeight = 0;
				var paddingBottom = 0;
				var paddingTop = 0;
				var marginBottom = 0;
				var opacity = 0;
				var overflow = "hidden";
			}
			// endregion

			this.alertWrap = BX.create("div", {
				props: { className: "ui-alert" },
				style: {
					"max-height": maxHeight,
					"overflow": overflow,
					"padding-top": paddingTop,
					"padding-bottom": paddingBottom,
					"margin-bottom": marginBottom,
					"opacity": opacity
				},
				children: [
					this.getTextNode(),
					this.getCloseBtn()
				]
			});

			// region if(animated)
			if (this.animated === true)
			{
				setTimeout(
					function() {
						this.alertWrap.style.maxHeight = "500px";
						this.alertWrap.style.removeProperty("padding-top");
						this.alertWrap.style.removeProperty("padding-botto");
						this.alertWrap.style.removeProperty("margin-bottom");
						this.alertWrap.style.opacity = 1;
					}.bind(this),
					10
				);

				setTimeout(
					function() {
						this.alertWrap.style.removeProperty("overflow");
						this.alertWrap.style.removeProperty("max-height");
						this.alertWrap.style.removeProperty("opacity");
					}.bind(this),
					260
				);
			}

			return this.alertWrap;
		}
	};

})();