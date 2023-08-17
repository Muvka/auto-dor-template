import React from 'react';
import clsx from 'clsx';
import punycode from 'punycode';

const types = ['email', 'tel'];
const ContactLine = ({ children = '', type = 'email', className = '' }) => {
	const checkedType = types.includes(type) ? type : types[0];
	let modifier = '';
	let url = '';

	switch (checkedType) {
		case 'email': {
			modifier = 'contact-line--email';
			url = `mailto:${children}`;

			break;
		}

		case 'tel': {
			modifier = 'contact-line--telephone';
			url = `tel:${children.replace(/[^0-9+#*]/g, '')}`;

			break;
		}
	}

	if (!children) {
		return null;
	}

	return (
		<p className={clsx('contact-line', modifier, className)}>
			{url ? (
				<a href={url} className='contact-line__link'>
					{checkedType === 'email' ? punycode.toUnicode(children) : children}
				</a>
			) : children}
		</p>
	);
};

export default ContactLine;
