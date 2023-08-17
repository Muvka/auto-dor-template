import React from 'react';
import clsx from 'clsx';

const TextContent = ({ children = null, className = '' }) => {
	if (!children) {
		return null;
	}

	return (
		<div className={clsx('text-content', className)} dangerouslySetInnerHTML={{ __html: children }} />
	);
};

export default TextContent;
