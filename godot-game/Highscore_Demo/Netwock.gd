extends Control

#var http_request : HTTPRequest = HTTPRequest.new()
#const SERVER_URL = "http://127.0.0.1/test.php"
#var request_queue : Array = []
#var is_requesting : bool = false
#
#func _ready():
#	randomize()
#
#	# Connect our request handler:
#	add_child(http_request)
#	http_request.connect("request_completed", self, "_http_request_completed")
#
#	# Connect our buttons:
#	$AddScore.connect("pressed", self, "_submit_score")
#	$GetScores.connect("pressed", self, "_get_scores")
#
#
#func _process(_delta):
#
#	# Check if we are good to send a request:
#	if is_requesting:
#		return
#
#	if request_queue.empty():
#		return
#
#	is_requesting = true
#	_send_request(request_queue.pop_front())
#
#
#func _http_request_completed(_result, _response_code, _headers, _body):
#	is_requesting = false
#	if _result != HTTPRequest.RESULT_SUCCESS:
#		printerr("Error w/ connection: " + String(_result))
#		return
#
#	var response_body = _body.get_string_from_utf8()
#	# Grab our JSON and handle any errors reported by our PHP code:
#	var response = parse_json(response_body)
#
#	# If not requesting a nonce, we handle all other requests here:
#	print("Response Body:\n" + response_body)
#
#func _send_request(request : Dictionary):
#	var client = HTTPClient.new()
#	var data = client.query_string_from_dict({"data" : JSON.print(request['data'])})
#	var body = "command=" + request['command'] + "&" + data
#
#	# Generate our 'response nonce'
#	var cnonce = String(Crypto.new().generate_random_bytes(32)).sha256_text()
#
#	# Generate our security hash:
#	var nonce = null
#
#	# Create our custom header for the request:
#	var headers = SERVER_HEADERS.duplicate()
#	headers.push_back("cnonce: " + cnonce)
#	headers.push_back("hash: " + client_hash)
#
#	# Make request to the server:
#	var err = http_request.request(SERVER_URL, headers, false, HTTPClient.METHOD_POST, body)
#
#	# Check if there were problems:
#	if err != OK:
#		printerr("HTTPRequest error: " + String(err))
#		return
#
#	# Print out request for debugging:
#	print("Requesting...\n\tCommand: " + request['command'] + "\n\tBody: " + body)
#

#func _submit_score():
#	var score = 0
#	var username = ""
#
#	# Generate a random username
#	var con = "bcdfghjklmnpqrstvwxyz"
#	var vow = "aeiou"
#	username = ""
#	for _i in range(3 + randi() % 4):
#		var string = con
#		if _i % 2 == 0:
#			string = vow
#		username += string.substr(randi() % string.length(), 1)
#		if _i == 0:
#			username = username.capitalize()
#	score = randi() % 1000
#
#	var command = "add_score"
#	var data = {"score" : score, "username" : username}
#	request_queue.push_back({"command" : command, "data" : data})
	
	
#func _get_scores():
#	var command = "get_scores"
#	var data = {"score_offset" : 0, "score_number" : 10}
#	request_queue.push_back({"command" : command, "data" : data});
func _get_scores():
	var err = 0
	var http = HTTPClient.new() # Create the Client.
	err = http.connect_to_host("http://networkpark.alwaysdata.net", 80) # Connect to host/port.
	assert(err == OK) # Make sure connection is OK.
	
	# Wait until resolved and connected.
	while http.get_status() == HTTPClient.STATUS_CONNECTING or http.get_status() == HTTPClient.STATUS_RESOLVING:
		http.poll()
		print("Connecting...")
		if not OS.has_feature("web"):
			OS.delay_msec(500)
		else:
			yield(Engine.get_main_loop(), "idle_frame")
	
	assert(http.get_status() == HTTPClient.STATUS_CONNECTED) # Check if the connection was made successfully.

	# Some headers
	var headers = [
		"User-Agent: Pirulo/1.0 (Godot)",
		"Accept: */*"
	]
	
	err = http.request(HTTPClient.METHOD_GET, "/test2.php", headers) # Request a page from the site (this one was chunked..)
	assert(err == OK) # Make sure all is OK.
	
	while http.get_status() == HTTPClient.STATUS_REQUESTING:
		# Keep polling for as long as the request is being processed.
		http.poll()
		print("Requesting...")
		if OS.has_feature("web"):
			# Synchronous HTTP requests are not supported on the web,
			# so wait for the next main loop iteration.
			yield(Engine.get_main_loop(), "idle_frame")
		else:
			OS.delay_msec(500)
			
	assert(http.get_status() == HTTPClient.STATUS_BODY or http.get_status() == HTTPClient.STATUS_CONNECTED) # Make sure request finished well.
	
	print("response? ", http.has_response()) # Site might not have a response.

	if http.has_response():
		# If there is a response...
		
		headers = http.get_response_headers_as_dictionary() # Get response headers.
		print("code: ", http.get_response_code()) # Show response code.
		print("**headers:\\n", headers) # Show headers.
		
		# Getting the HTTP Body
		
		if http.is_response_chunked():
			# Does it use chunks?
			print("Response is Chunked!")
		else:
			# Or just plain Content-Length
			var bl = http.get_response_body_length()
			print("Response Length: ", bl)
		
		# This method works for both anyway
		
		var rb = PoolByteArray() # Array that will hold the data.
		
		while http.get_status() == HTTPClient.STATUS_BODY:
			# While there is body left to be read
			http.poll()
			# Get a chunk.
			var chunk = http.read_response_body_chunk()
			if chunk.size() == 0:
				if not OS.has_feature("web"):
					# Got nothing, wait for buffers to fill a bit.
					OS.delay_usec(1000)
				else:
					yield(Engine.get_main_loop(), "idle_frame")
			else:
				rb = rb + chunk # Append to read buffer.
		# Done!

		print("bytes got: ", rb.size())
		var text = rb.get_string_from_ascii()
		print("Text: ", text)
		get_node("Label").text = text
	
	
func _ready():
	# Connect our buttons:
	$AddScore.connect("pressed", self, "_submit_score")
	$GetScores.connect("pressed", self, "_get_scores")
