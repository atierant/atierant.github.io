require 'nokogiri'
require 'open-uri'
require 'uri'

module Jekyll

  class RemoteFooterTag < Liquid::Tag

    def initialize(tag_name, markup, tokens)
      #markup is what is defined in the tag. Lets make it a URL so devs
      #don't have to update code if the URL changes.
      url = markup

      #check if the URL is valid
      if url =~ URI::regexp
        #grab the remote document with nokogiri
        doc = Nokogiri::HTML(open(url))

        #search the document for the HTML element you want
        @node = doc.at_xpath("//div[@id='footer']")
      else
        raise 'Invalid URL passed to RemoteFooterTag'
      end

      super
    end

    def render(context)
      output = super
      if @node
        node.to_s
      else
        "Something went wrong in RemoteFooterTag"
      end
    end
  end
end

Liquid::Template.register_tag('remote_footer', Jekyll::RemoteFooterTag)