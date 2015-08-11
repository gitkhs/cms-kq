function searchTab(n,tabsid)
{
	for(i = 0; i < 2; i++)
	{
		if (i == 0) getId(tabsid + i).className = 'split';
		else getId(tabsid + i).className = '';

		getId(tabsid + 'i' + i).style.visibility = "hidden";
		getId(tabsid + '_' + i).style.display = "none";
	}
	if (n == 0) getId(tabsid + n).className = 'on split';
	else getId(tabsid + n).className = 'on';

	getId(tabsid + 'i' + n).style.visibility = 'visible';
	getId(tabsid + '_' + n).style.display = 'block';
}
