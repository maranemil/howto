/**
 * Created by emil on 08.12.15.
 */


// -------------------------------------------------------------
// SugarCRM:Sidecar: Change Edit list max per page in subpanel any module
// https://gist.github.com/betobaz/
// -------------------------------------------------------------

({
	extendsFrom: 'SubpanelListView',

	initialize: function(options) {
		// `dataViewName` corresponds to the list of fields the API should retrieve.
		this.dataViewName = options.name || 'subpanel-list';

		this._super("initialize", [options]);
		var limit = this.context.get('limit') || app.config.maxSubpanelResult;
		// Setup max limit on collection's fetch options for this subpanel's context
		if(this.context.get('module') === 'Cases'){
			debugger;
			limit = 2;
		}
		if (limit) {
			this.context.set('limit', limit);
			//supanel-list extends indirectly ListView, and `limit` determines # records displayed
			this.limit = limit;
			// FIXME SC-3670 needs to remove this `collectionOptions` mess.
			var collectionOptions = this.context.has('collectionOptions') ? this.context.get('collectionOptions') : {};
			this.context.set('collectionOptions', _.extend(collectionOptions, {limit: limit}));
		}

		//Override the recordlist row template
		this.rowTemplate = app.template.getView('recordlist.row');

		this.layout.on("hide", this.toggleList, this);
		// Listens to parent of subpanel layout (subpanels)
		this.listenTo(this.layout.layout, 'filter:change', this.renderOnFilterChanged);
		this.listenTo(this.layout, 'filter:record:linked', this.renderOnFilterChanged);

		//event register for preventing actions
		//when user escapes the page without confirming deletion
		app.routing.before("route", this.beforeRouteUnlink, this, true);
		$(window).on("beforeunload.unlink" + this.cid, _.bind(this.warnUnlinkOnRefresh, this));
	},
})

// -------------------------------------------------------------
// SugarCRM:Sidecar:Modify list selection for "Link Existing Record"
// -------------------------------------------------------------

({
	extendsFrom: 'LinkActionField',

	openSelectDrawer: function() {
		if (this.isDisabled()) {
			return;
		}
		var parentModel = this.context.get('parentModel'),
			linkModule = this.context.get('module'),
			link = this.context.get('link'),
			self = this;
		// Validate name link
		if(linkModule === "Contacts" ){
			var model = self.context.parent.get("model");

			var filters = [
				//{"compania_c": {"$in": model.get("region")}},

			];
			self.usersCollection = app.data.createBeanCollection(linkModule);
			var request = self.usersCollection.fetch({"filter": filters});
			request.xhr.success(function(data){
				app.drawer.open({
						layout: 'selection-list',
						context: {
							module: linkModule,
							collection:self.usersCollection,
							filterOptions:{auto_apply:false,},
						}
					},
					function(model) {
						if (!model) {
							return;
						}
						var relatedModel = app.data.createRelatedBean(parentModel, model.id, link),
							options = {
								//Show alerts for this request
								showAlerts: true,
								relate: true,
								success: function(model) {
									//We've just linked a related, however, the list of records from
									//loadData will come back in DESC (reverse chronological order with
									//our newly linked on top). Hence, we reset pagination here.
									self.context.get('collection').resetPagination();
									self.context.resetLoadFlag();
									self.context.set('skipFetch', false);
									//Reset limit on context so we don't "over fetch" (lose pagination)
									var collectionOptions = self.context.get('collectionOptions') || {};
									if (collectionOptions.limit) self.context.set('limit', collectionOptions.limit);
									self.context.loadData({
										success: function() {
											self.view.layout.trigger('filter:record:linked');
										},
										error: function(error) {
											app.alert.show('server-error', {
												level: 'error',
												messages: 'ERR_GENERIC_SERVER_ERROR'
											});
										}
									});
								},
								error: function(error) {
									app.alert.show('server-error', {
										level: 'error',
										messages: 'ERR_GENERIC_SERVER_ERROR'
									});
								}
							};
						relatedModel.save(null, options);
					});
			});
		}
		else{
			// funcionalidad normal para los subpaneles a los que no aplica la personalizacion
			app.drawer.open({
				layout: 'selection-list',
				context: {
					module: linkModule,
					recParentModel: parentModel,
					recLink: link,
					recContext: this.context,
					recView: this.view
				}
			}, function(model) {
				if (!model) {
					return;
				}
				var relatedModel = app.data.createRelatedBean(parentModel, model.id, link),
					options = {
						//Show alerts for this request
						showAlerts: true,
						relate: true,
						success: function(model) {
							//We've just linked a related, however, the list of records from
							//loadData will come back in DESC (reverse chronological order with
							//our newly linked on top). Hence, we reset pagination here.
							self.context.get('collection').resetPagination();
							self.context.resetLoadFlag();
							self.context.set('skipFetch', false);
							//Reset limit on context so we don't "over fetch" (lose pagination)
							var collectionOptions = self.context.get('collectionOptions') || {};
							if (collectionOptions.limit) self.context.set('limit', collectionOptions.limit);
							self.context.loadData({
								success: function() {
									self.view.layout.trigger('filter:record:linked');
								},
								error: function(error) {
									app.alert.show('server-error', {
										level: 'error',
										messages: 'ERR_GENERIC_SERVER_ERROR'
									});
								}
							});
						},
						error: function(error) {
							app.alert.show('server-error', {
								level: 'error',
								messages: 'ERR_GENERIC_SERVER_ERROR'
							});
						}
					};
				relatedModel.save(null, options);
			});
		}
	}

})

// -------------------------------------------------------------
// SugarCRM: Sidecar: save new bean with id
// https://gist.github.com/betobaz/8903da727396b6a346ce
// -------------------------------------------------------------

({
	events:{
		'click .button': '_createMeeting',
	},
	_createMeeting: function(){
		var meeting = app.data.createBean('Meetings');
		meeting.set({
			// Create its UUID
			id: app.utils.generateUUID(),
			name: 'Test',
			date_start: '2015-09-15'+'T09:00:00',
			duration_minutes: 30,
			duration_hours: 0,
			parent_type: 'Accounts',
			parent_id: '387643b8-626b-2a7c-86ff-55a5f9c3b44e',
			parent_name: 'Acount test'
		});
		// Force to save with POST
		meeting.id=null;
		meeting.save();
	}
})

// -------------------------------------------------------------
// SugarCRM:Sidecar:Collection fetch with filter
// https://gist.github.com/betobaz/e86d3a606ff87e39e913
// -------------------------------------------------------------

// Nombre del modulos a consultar
var moduleName = "T01_Telefonos";
// Filtros que se desean aplicar
var filters = [
	// Se va a filtrar por la relacion que tiene el modulo con cuentas
	{t01_telefonos_accountsaccounts_ida: "eff78d90-03c1-dbd0-fe8e-55f060047d98"}
];
// Se crea un collecion del modulo, el cual se va a llenar cuando el api nos de respuesta
var telCollection = App.data.createBeanCollection(moduleName);
// Se realiza la peticion
var req = telCollection.fetch({"filter": filters});
// Se

function processTelefonos(){
	// arguments es una variable que contien un array con los argumentos que recibe la funcion
	// por lo regular lo ocupo para saber que argumentos recibie y posteriormente los defino en
	// los parentesis de la funcion
	console.log(arguments);
	// Una coleccion contiene un atributo llamado models.
	// models es un array que contiene los modelos del resultado de la petición al api
	// every es una funcion que recibe como parametro otra funcion la cual va a procesar
	// cada uno de los elemento de un array
	telCollection.models.every(function(model){
		console.log(model.get('name'));
	});
	debugger;
}

// Se agrega un callback, en este caso nuestra funcion processTelefonos el cual
// va a procesar la respuesta del api.
req.xhr.success(processTelefonos);


// -------------------------------------------------------------
// SugarCRM: Sidecar: Open create-actions layout in a drawer on demand
// https://gist.github.com/betobaz/587662ead1fdf5d5dad4
// -------------------------------------------------------------

({
	events:{
		'click button': '_handlerClick',
	},
	_handlerClick: function(evt, el){
		var modelPrefil = app.data.createBean("Accounts");
		modelPrefil.set({
			name: "Account name",
			assigned_user_name: 1
		});

		self.drawer = app.drawer.open({
			layout: "create-actions",
			context:{
				create: true,
				model: modelPrefil
			}

		}, function(){
			console.log("After save", arguments);
		});

		app.once("app:view:change", function(name, attributes){
			console.log('After drawer display');
		});
	}
})

// -------------------------------------------------------------
// SugarCRM: Sidecar: Set readonly to field
// https://gist.github.com/betobaz/1a38f4076e18dd99c6af
// -------------------------------------------------------------

({
	initialize: function(){
		this._super("initialize", arguments);
		var field = this.getField('field_name');
		field.setMode('readonly');
		field.setMode('edit');
		field.setMode('detail');
	}
})

// -------------------------------------------------------------
// SugarCRM::Sidecar::Show model in preview
// trigger-preview.js
// -------------------------------------------------------------

({
	showPreview: function(moduleName, modelId){
		var bean = App.data.createBean(moduleName, {id:modelId});
		bean.fetch();
		App.events.trigger('preview:render', bean);
	}
})

// -------------------------------------------------------------
// https://gist.github.com/betobaz/0eb87158bacd1a65414d
// getRecordsRecursive.js
// -------------------------------------------------------------


({
	getRecordsRecursive: function(moduleName, filters, offset, collectionBuffer, callback){
		var self = this;
		if(offset > -1){
			var collection = App.data.createBeanCollection(moduleName);
			var req = collection.fetch({"filter": filters, "offset": offset});
			req.xhr.success(function(data){
				if(data.records){
					collectionBuffer.add(data.records);
					self.getRecordsRecursive(moduleName, filters, data.offset, collectionBuffer, callback);
				}
			});
		}
		else{
			callback(collectionBuffer);
		}
	}
})

// -------------------------------------------------------------
// SugarCRM::Sidecar::list-bottom::Remove loading message
// https://gist.github.com/betobaz/b8d1c36338691eecfa00
// custom__clients__base__views__list-bottom__list-bottom.js
// -------------------------------------------------------------

/**
 * @class View.Views.Base.ListBottomView
 * @alias SUGAR.App.view.views.BaseListBottomView
 * @extends View.View
 */
({
	events: {
		'click [data-action="show-more"]': 'showMoreRecords'
	},

	initialize: function(options) {
		this._super('initialize', [options]);
		this._initPagination();
	},

	/**
	 * Initialize pagination component in order to react the show more link.
	 * @private
	 */
	_initPagination: function() {
		this.paginationComponent = _.find(this.layout._components, function(component) {
			return _.contains(component.plugins, 'Pagination');
		}, this);
	},

	/**
	 * Retrieving the next page records by pagination plugin.
	 *
	 * Please see the {@link app.plugins.Pagination#getNextPagination}
	 * for detail.
	 */
	showMoreRecords: function() {
		if (!this.paginationComponent) {
			return;
		}

		this.paginateFetched = false;
		this.render();

		var options = {};
		options.success = _.bind(function() {
			this.layout.trigger('list:paginate:success');
			this.paginateFetched = true;
			this.render();
		}, this);

		this.paginationComponent.getNextPagination(options);
	},

	/**
	 * Assign proper label for 'show more' link.
	 * Label should be "More <module name>...".
	 */
	setShowMoreLabel: function() {
		var model = this.collection.at(0),
			module = model ? model.module : this.context.get('module');
		this.showMoreLabel = app.lang.get('TPL_SHOW_MORE_MODULE', module, {
			module: new Handlebars.SafeString(app.lang.getModuleName(module, {plural: true}).toLowerCase()),
			count: this.collection.length,
			offset: this.collection.next_offset >= 0
		});
	},

	/**
	 * Reset previous collection handlers and
	 * bind the listeners for new collection.
	 */
	onCollectionChange: function() {
		var prevCollection = this.context.previous('collection');
		if (prevCollection) {
			prevCollection.off(null, null, this);
		}
		this.collection = this.context.get('collection');
		this.collection.on('add remove reset', this.render, this);
		this.render();
	},

	/**
	 * {@inheritDoc}
	 *
	 * Bind listeners for collection updates.
	 * The pagination link synchronizes its visibility with the collection's
	 * status.
	 */
	bindDataChange: function() {
		this.context.on('change:collection', this.onCollectionChange, this);
		this.collection.on('add remove reset', this.render, this);
		this.before('render', function() {
			this.dataFetched = this.paginateFetched !== false && this.collection.dataFetched;
			this.showLoadMsg = true;
			var filterOptions = this.layout.context.get('filterOptions');
			if( filterOptions && filterOptions.auto_apply === false){
				this.showLoadMsg = false;
			}
			if (app.alert.$alerts[0].innerText || !app.acl.hasAccessToModel('list', this.model)) {
				this.showLoadMsg = false;
			}

			var nextOffset = this.collection.next_offset || -1;
			if (this.collection.dataFetched && nextOffset === -1) {
				this._invisible = true;
				this.hide();
				return false;
			}
			this._invisible = false;
			this.show();
			this.setShowMoreLabel();
		}, null, this);
	},

	/**
	 * {@inheritDoc}
	 *
	 * Avoid to be shown if the view is invisible status.
	 * Add dashlet placeholder's class in order to handle the custom css style.
	 */
	show: function() {
		if (this._invisible) {
			return;
		}
		this._super('show');
		if (!this.paginationComponent) {
			return;
		}
		this.paginationComponent.layout.$el.addClass('pagination');
	},

	/**
	 * {@inheritDoc}
	 *
	 * Remove pagination custom CSS class on dashlet placeholder.
	 */
	hide: function() {
		this._super('hide');
		if (!this.paginationComponent) {
			return;
		}
		this.paginationComponent.layout.$el.removeClass('pagination');
	}
})

// -------------------------------------------------------------
// record.js
// -------------------------------------------------------------

({
	extendsFrom: 'RecordView',
	initialize: function (options) {
		this._super('initialize', [options]);
		this.model.on('change:case_primary_contact_c', this.updateAccount, this);
	},
	updateAccount: function () {
		if (!_.isEmpty(this.model.get('contact_id_c')) && !_.isEqual(this.model.get('contact_id_c'), this.model.previous('contact_id_c'))) {
			var contact_id = this.model.get('contact_id_c'),
				url = app.api.buildURL('Contacts/' + contact_id + '/link/accounts_contacts/'),
				self = this;
			app.api.call('GET', url, null, {
				success: _.bind(function (data) {
					if (data.records.length == 1) {
						//there is only one account related to the selected contact
						//set the account name and id in the Account Relate field.
						self.model.set('account_id', data.records[0].id);
						self.model.set('account_name', data.records[0].name);
					} else if (data.records.length > 1) {
						//there are multiple Accounts related to this Contact
						//create a Collection with these accounts and open a selection list with this
						//collection to choose from
						var parentModel = self.model,
							linkModule = 'Accounts',
							accounts = app.data.createBeanCollection("Accounts", data.records);
						app.drawer.open({
							layout: 'selection-list',
							context: {
								module: linkModule,
								parentModel: parentModel,
								collection: accounts,
								filterOptions: {
									auto_apply: false,
								},
							}
						}, function (selectedModel) {
							if (!_.isEmpty(selectedModel)) {
								self.model.set('account_id', selectedModel.id);
								self.model.set('account_name', selectedModel.name);
							}
						});
					}
				}, this),
				error: _.bind(function (o) {
					console.log("Error retrieving Account related to Contact" + o);
				}, this),
			});
		}
	}
});

// -------------------------------------------------------------
// SugarCRM::Sidecar::Load Google Maps Api Async
// custom_clients_base_views_map-dashlet_map-dashlet.js
// https://gist.github.com/betobaz/719e42da1868e0f6d9e9
// -------------------------------------------------------------

({
	plugins: ['Dashlet'],
	initialize: function (options) {
		var self = this;
		this._super('initialize', [options]);
		// Escuchador que se detona cuando se ha detectado que el api de
		self.context.on('google:maps:api:load', _.bind(self._googleMapsApiLoadHandler, self));
		// Se define la función callback que se va a ejecutar cuando google maps api ya esta disponible
		window.mapsApiCallback = function(){
			console.log('hola mundo, maps api cargado');
			// Detona evento personalizado para que sea cachado por algun escuchador
			self.context.trigger('google:maps:api:load');
		}
		// Se valida que google y google.maps no esten disponibles para cargar el script
		if(_.isUndefined(window.google) || _.isUndefined(window.google.maps)){
			this.loadStript();
		}
		else{
			// Si esta disponible se dispara el evento personalizado
			self.context.trigger('google:maps:api:load');
		}
	},
	// funcion que se encarga de importar el script del api de google maps
	loadStript: function() {
		var script = document.createElement('script');
		script.type = 'text/javascript';
		// se indica la url mas el nombre de la funcion callback que se dispara cuando este listo
		script.src = 'https://maps.googleapis.com/maps/api/js?v=3.exp' +
			'&signed_in=true&callback=mapsApiCallback';
		document.body.appendChild(script);
	},
	_googleMapsApiLoadHandler: function(){
		console.log('cachandolo en el dashlet');
		debugger;
	}
})

// -------------------------------------------------------------
//  custom record.js
// https://gist.github.com/betobaz/26afa4287aa05d88d535
// -------------------------------------------------------------

({
	extendsFrom: 'RecordView',
	initialize: function (options) {
		this._super('initialize', arguments);
		debugger;
		this.model.on("change:solucion_c",this.calculate, this);
	},

	calculate:function() {
		var solucion_c = this.model.get('solucion_c');
		console.log("fun cal"+ solucion_c);
		debugger;
		if (solucion_c == true)
			this.model.set('probability',25);
	}
})


// -------------------------------------------------------------
//  https://gist.github.com/betobaz/6552969
// -------------------------------------------------------------

var sys = require('util'),
	rest = require('restler');

var baseurl = "<<instance URL>>/rest/v10"

// get oAuth token
var jsonData = {"grant_type":"password","username":"<<username>>","password":"<<password>>","client_id":"sugar"};
rest.postJson(baseurl+'/oauth2/token', jsonData).on('2XX', function(data) {
	if ( data.error ) {
		sys.puts("Error: " + data.error_message);
	}

	var token = data.access_token;
	sys.puts('Success! OAuth token is ' + token);

	// now with a token, make a call
	rest.get(baseurl+"/me", {
		headers:  { "Content-Type" : "application/json", "OAuth-Token": token }
	}).on('2XX', function(data) {
		if ( data.error ) {
			sys.puts("Error: " + data.error_message);
		}
		sys.puts(JSON.stringify(data));
	});
});
















