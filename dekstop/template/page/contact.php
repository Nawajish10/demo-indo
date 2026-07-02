<main id="main-route">
	<div class="main-content contact-us">
		<div class="container">
			<div class="page-header">Contact Us</div>
			<div class="contact-us__content">
				<div class="row">
					<div class="col-lg-6 col-md-6 mb-2">
						<a href="https://www.livechat.com/chat-with/<?php echo isset($liat_lc['id_livechat']) ? $liat_lc['id_livechat'] : '' ?>/" target="_blank" rel="noreferrer">
							<div class="contact-us__item">
								<div class="item-header live-chat">LIVECHAT</div>
								<div class="item-content">
									<h5 class="title">LiveChat</h5>
									<div class="description">Contact our 24/7 support team and we will be glad to assist you.</div>
								</div>
							</div>
						</a>
					</div>
					<div class="col-lg-6 col-md-6 mb-2">
						<a href="https://wa.me/<?php echo $whatsapp ?>" target="_blank" rel="noreferrer">
							<div class="contact-us__item">
								<div class="item-header whatsapp">
								WHATSAPP</div>
								<div class="item-content">
									<h5 class="title">WhatsApp</h5>
									<div class="description">Chat with our official WhatsApp support representative anytime.</div>
								</div>
							</div>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="main-content game">
		<div class="container">
			<div class="game__seo">
				<div hidden id="title-seo">Contact Demo India Support</div>
				<div class="seo-content showFooter" >
					<h1>
						<strong><?php echo $judul; ?> Official Support - Register &amp; Login</strong>
					</h1>
					<p>
						Welcome to the official Demo India Gaming Platform customer support page.
					</p>
					<p>&nbsp;</p>
					<h2>
						Official WhatsApp and LiveChat 24/7
					</h2>
					<p>
						<strong>WhatsApp :</strong>
						<span style="color:hsl(0,0%,100%);">
						</span>
						<a href="https://api.whatsapp.com/send/?phone=<?php echo $whatsapp ?>">
							<span style="background-color:hsl(0,0%,0%);color:hsl(0,0%,100%);">
								<strong>https://api.whatsapp.com/send/?phone=</strong><?php echo $whatsapp; ?>
							</span>
						</a>
					</p>
					<p>
						<span style="color:hsl(0,0%,0%);">
							<strong>Official LiveChat Support :</strong>
						</span><span style="color:hsl(0,0%,100%);"> 
						</span>
						<a href="https://secure.livechatinc.com/customer/action/open_chat?license_id=<?php echo $id_livechat ?>">
							<span style="background-color:hsl(0,0%,0%);color:hsl(0,0%,100%);">https://secure.livechatinc.com/customer/action/open_chat?license_id=<?php echo $id_livechat ?>
							</span>
						</a>
					</p>
				</div>
			</div>
		</div>
	</div>
</main>