extends Node2D


func _get_question(idQuest):
	var err = 0
	var http = HTTPClient.new() # Create the Client.
	err = http.connect_to_host("http://127.0.0.1", 80) # Connect to host/port.
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
	
	err = http.request(HTTPClient.METHOD_GET, "/test2.php?command=get_question&idQuestion="+String(idQuest), headers) # Request a page from the site (this one was chunked..)
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
		var text = rb.get_string_from_utf8()
		return text
	
	
func _submit_score():
	var score = 13
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
	
	err = http.request(HTTPClient.METHOD_GET, "/test2.php?command=add_score&score="+String(score), headers) # Request a page from the site (this one was chunked..)
	assert(err == OK) # Make sure all is OK.
	
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
	var score = 20
	
	err = http.request(HTTPClient.METHOD_GET, "/test2.php?command=get_score", headers) # Request a page from the site (this one was chunked..)
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
		var text = rb.get_string_from_utf8()
		print("Text: ", text)

var nbQuest = 2
var questions = []
func _ready():
	randomize()
	for id in range(nbQuest) :
		questions.append(JSON.parse(_get_question(id+1)).result)
		set_next_pc()
#		while idResponses.size() > 0 : # On met les réponses dans les pc
#			get_node("PC" + String(id+1) + "/Sombre/Q1/R" + String(idResponses[0]) + "/box/MarginContainer/HBoxContainer/Label").text = " " + String(questions[id].values()[6-idResponses.size()]) + " "
#			get_node("PC" + String(id+1) + "/Sombre/Q1/R" + String(idResponses[0]) + "/CollisionMouse")
#			if questions[id].values()[6-idResponses.size()] == questions[id]["bonneReponse"] : # Si c'est la bonne réponse, on l'indique au script du pc
#				get_node("PC" + String(id+1)).idReponse = String(idResponses[0])
#			idResponses.pop_front()

func set_next_pc():
	var idResponses = [1,2,3,4]
	idResponses.shuffle()
	print(idResponses)
	get_node("CanvasLayer/Sombre/Q1").text = questions[get_node("KinematicBody2D").pcid-1]["tupleQuestion"]
	while idResponses.size() > 0 : # On met les réponses dans les pc
		get_node("CanvasLayer/Sombre/Q1/R" + String(idResponses[0]) + "/box/MarginContainer/HBoxContainer/Label").text = " " + String(questions[get_node("KinematicBody2D").pcid-1].values()[6-idResponses.size()]) + " "
		if questions[get_node("KinematicBody2D").pcid-1].values()[6-idResponses.size()] == questions[get_node("KinematicBody2D").pcid-1]["bonneReponse"] : # Si c'est la bonne réponse, on l'indique au script du pc
			get_node("PC" + String(get_node("KinematicBody2D").pcid)).idReponse = idResponses[0]
			get_node("PC" + String(get_node("KinematicBody2D").pcid)).ready = true
		idResponses.pop_front()
			
func _process(delta):
	print("box : " + String(get_node("CanvasLayer/Sombre/Q1/R1/box").rect_size))
	print(get_node("CanvasLayer/Sombre/Q1/R1/CollisionMouse").shape.get("extents").x)
	pass

