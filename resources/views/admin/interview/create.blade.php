@extends('layouts.admin.base')

@section('title')
<title>Crear Entrevista</title>
@endsection

@section('pre-css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
@endsection

@section('css')
<style>
input[type="checkbox"] {
  position: relative;
  width: 40px;
  height: 20px;
  -webkit-appearance: none;
  appearance: none;
  background: red;
  outline: none;
  border-radius: 2rem;
  cursor: pointer;
  box-shadow: inset 0 0 5px rgb(0 0 0 / 50%);
}

input[type="checkbox"]::before {
  content: "";
  width: 20px;
  height: 20px;
  border-radius: 50%;
  background: #fff;
  position: absolute;
  top: 0;
  left: 0;
  transition: 0.5s;
}

input[type="checkbox"]:checked::before {
  transform: translateX(100%);
  background: #fff;
}

input[type="checkbox"]:checked {
  background: #00ed64;
}

.tab-link:active,.tab-link:hover{
    text-decoration: none;
    color: white;
}

[role="tablist"] {
  background: #7843e6;
  padding: 0;
  margin: 0;
}

[role="presentation"] {
  display: block;
}

[role="presentation"][data-tab-active] {
  background: #7843e6;
  -webkit-transition: all 100ms cubic-bezier(0.42, 0, 1, 1);
  transition: all 100ms cubic-bezier(0.42, 0, 1, 1);
}

[role="tab"] {
/*   border: 3px solid transparent; */
  color: #fff;
  display: block;
  padding: 1rem 2rem;
  position: relative;
  text-decoration: none;
  -webkit-transition: all 100ms cubic-bezier(0.42, 0, 1, 1);
  transition: all 100ms cubic-bezier(0.42, 0, 1, 1);
}

[role="tab"]:focus {
    outline: 0;
    background-color: #7843e6;
    box-shadow: inset 0 0 0 3px #7843e6;
}

[role="tabpanel"] {
  background: #f0f0f0;
  padding: 1rem;
}

[role="tabpanel"] h2 {
  margin-top: 0;
}

[role="tabpanel"][aria-hidden="true"] {
  display: none;
}

[role="tabpanel"]:focus {
  outline: 0;
  box-shadow: inset 0 0 0 2px #7843e6;
}

@media screen and (min-width: 800px) {
  [role="presentation"] {
    display: inline-block;
  }

  [role="presentation"][data-tab-active] [role="tab"]:after {
    content: '';
    display: inline-block;
    margin: auto;
    position: absolute;
    bottom: -9px;
    left: 0;
    right: 0;
    width: 0;
    height: 0;
    border-left: 10px solid transparent;
    border-right: 10px solid transparent;
    border-top: 10px solid #7843e6;
  }
}

</style>
@endsection

@section('description')
<meta name="description" content="Crear entrevista">
@endsection

@section('content-title')
Entrevista
@endsection

@section('content-subtitle')
Crear
@endsection

@section('content')

<form action="{{route('entrevistas.store')}}" method="POST" id="agregar-entrevista" class="col-md-10 mx-auto" enctype='multipart/form-data'>
    @csrf
    <label for="position">Nombre del puesto</label>
    <input name="position" id="position" type="text" class="form-control mb-4" placeholder="Introduzca el nombre del puesto a postularse.." required value="{{ old('position') }}">
    <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
    <div data-tab-component>
        <ul class="tab-list">
        @for($i = 0; $i < 5; $i++)  
        <li class="tab-item">
            <a class="tab-link" href="#section-{{$i}}">Pregunta {{$i + 1}}</a>
        </li>
        @endfor
        </ul>
        {{-- por cada pregunta se crea un tab con su respecitvo input --}}
        @for($i = 0; $i < 5; $i++)
            <section id="section-{{$i}}" class="tab-panel">
            <label for="question{{$i}}">{{$i + 1}}° pregunta para la entrevista</label>
            <input name="question[]" id="question{{$i}}" type="text" class="form-control mb-4" placeholder="Escriba la pregunta que quiere realizar.." required value="{{ old("question.$i") }}"> 
            <label for="question{{$i}}">¿La respuesta precisa de video?  </label>
            <input type="checkbox" value="0" name="video[{{$i}}]">
            </section>
        @endfor
        <div class="form-group row justify-content-center">
            <button type="submit" class="btn btn-success" name="crear"><i class="fa-solid fa-plus"></i> CREAR</button>
        </div>
    </form>
  </div>
@endsection

@section('pre-plugins')
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
@endsection

@section('js')

<script>
window.a11yTabs = (function tabsComponentIIFE(global, document) {
  'use strict';

  const tabInstances = new WeakMap();

  /**
   * Instantiates the component
   * @constructor
   * @param {DOM Node} element
   */
  const TabComponent = function TabComponent(element, options) {
    if (!element || !element.nodeType) {
      throw new Error(
        'The DOM element was not found when creating the tab component'
      );
    }
    const defaults = {
      tabList: '.tab-list',
      tabItem: '.tab-item',
      tabLink: '.tab-link',
      tabPanel: '.tab-panel'
    };
    this.options = Object.assign(defaults, options);

    this.element = element;
    this.tabList = element.querySelector(this.options.tabList);
    this.tabItems = [].slice.call(
      this.tabList.querySelectorAll(this.options.tabItem)
    );
    this.tabLinks = [].slice.call(
      this.tabList.querySelectorAll(this.options.tabLink)
    );
    this.tabPanels = [].slice.call(
      element.querySelectorAll(this.options.tabPanel)
    );

    this.currentIndex = 0;

    this.tabList.setAttribute('role', 'tablist');

    this.tabItems.forEach((item, index) => {
      item.setAttribute('role', 'presentation');

      if (index === 0) {
        item.setAttribute('data-tab-active', '');
      }
    });

    this.tabLinks.forEach((item, index) => {
      item.setAttribute('role', 'tab');
      item.setAttribute('id', 'tab' + index);

      if (index > 0) {
        item.setAttribute('tabindex', '-1');
      } else {
        item.setAttribute('aria-selected', 'true');
      }
    });

    this.tabPanels.forEach((item, index) => {
      item.setAttribute('role', 'tabpanel');
      item.setAttribute('aria-labelledby', 'tab' + index);
      item.setAttribute('tabindex', '-1');

      if (index > 0) {
        item.setAttribute('hidden', '');
      }
    });

    this.eventCallback = handleEvents.bind(this);
    this.tabList.addEventListener('click', this.eventCallback, false);
    this.tabList.addEventListener('keydown', this.eventCallback, false);

    tabInstances.set(this.element, this);
  };

  TabComponent.prototype = {
    /**
     * Event handler for all tab interactions
     * @param {number} index - Index of the tab being activiated
     * @param {string} direction -
     */
    handleTabInteraction: function handleTabInteraction(index, direction) {
      const currentIndex = this.currentIndex;
      let newIndex = index;

      // The click event does not pass in a direction. This is for keyboard support
      if (direction) {
        if (direction === 37) {
          newIndex = index - 1;
        } else {
          newIndex = index + 1;
        }
      }

      // Supports continuous tabbing when reaching beginning or end of tab list
      if (newIndex < 0) {
        newIndex = this.tabLinks.length - 1;
      } else if (newIndex === this.tabLinks.length) {
        newIndex = 0;
      }

      // update tabs
      this.tabLinks[currentIndex].setAttribute('tabindex', '-1');
      this.tabLinks[currentIndex].removeAttribute('aria-selected');
      this.tabItems[currentIndex].removeAttribute('data-tab-active');

      this.tabLinks[newIndex].setAttribute('aria-selected', 'true');
      this.tabItems[newIndex].setAttribute('data-tab-active', '');
      this.tabLinks[newIndex].removeAttribute('tabindex');
      this.tabLinks[newIndex].focus();

      // update tab panels
      this.tabPanels[currentIndex].setAttribute('hidden', '');
      this.tabPanels[newIndex].removeAttribute('hidden');

      this.currentIndex = newIndex;

      return this;
    },

    /**
     * Set tab panel focus
     * @param {number} index - Tab panel index to receive focus
     */
    handleTabpanelFocus: function handleTabPanelFocus(index) {
      this.tabPanels[index].focus();

      return this;
    }
  };

  /**
   * Creates or returns existing component
   * @param {string} selector
   */
  function createTabComponent(selector, options) {
    const element = document.querySelector(selector);
    return tabInstances.get(element) || new TabComponent(element, options);
  }

  /**
   * Destroys an existing component
   * @param {DOM Node} element
   */
  function destroyTabComponent(element) {
    if (!element || !element.nodeType) {
      throw new Error(
        'The DOM element was not found when deleting the tab component'
      );
    }

    let component = tabInstances.get(element);
    component.tabList.removeAttribute('role', 'tablist');

    component.tabItems.forEach((item, index) => {
      item.removeAttribute('role', 'presentation');

      if (index === 0) {
        item.removeAttribute('data-tab-active');
      }
    });

    component.tabLinks.forEach((item, index) => {
      item.removeAttribute('role', 'tab');
      item.removeAttribute('id', 'tab' + index);

      if (index > 0) {
        item.removeAttribute('tabindex', '-1');
      } else {
        item.removeAttribute('aria-selected', 'true');
      }
    });

    component.tabPanels.forEach((item, index) => {
      item.removeAttribute('role', 'tabpanel');
      item.removeAttribute('aria-labelledby', 'tab' + index);
      item.removeAttribute('tabindex', '-1');

      if (index > 0) {
        item.removeAttribute('hidden');
      }
    });

    component.tabList.removeEventListener('click', component.eventCallback);
    component.tabList.removeEventListener('keydown', component.eventCallback);
    tabInstances.delete(component.element);
  }

  /**
   * Handles all event listener callbacks
   * @param {event} event
   */
  function handleEvents(event) {
    if (event.type === 'click') {
      event.preventDefault();
      TabComponent.prototype.handleTabInteraction.call(
        this,
        this.tabLinks.indexOf(event.target)
      );
    }

    if (event.type === 'keydown') {
      const index = this.tabLinks.indexOf(event.target);

      // Left and right arrows
      if (event.which === 37 || event.which === 39) {
        event.preventDefault();
        TabComponent.prototype.handleTabInteraction.call(
          this,
          index,
          event.which
        );
      }

      // Down arrow
      if (event.which === 40) {
        event.preventDefault();
        TabComponent.prototype.handleTabpanelFocus.call(this, index);
      }
    }
  }

  return {
    create: createTabComponent,
    destroy: destroyTabComponent
  };
})(window, document);

const tabComponent = a11yTabs.create('[data-tab-component]')
</script>
@endsection